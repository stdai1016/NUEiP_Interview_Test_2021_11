<?php
abstract class Vehicle {

    public $name;

    /**
     * @var float 車輛剩餘油量
     */
    protected $petrol;

    public function __construct(string $name) {
        $this->name = $name;
        $this->petrol = 0;
    }

    /**
     * @return float 車輛剩餘油量
     */
    public function petrolLeft() {
        return $this->petrol;
    }

    /**
     * 車輛都需要加油
     * @param float $liter
     */
    public function fillUp(float $liter) {
        $liter = $liter > 0 ? $liter : 0;
        $this->petrol += $liter;
        $this->petrol = $this->petrol < $this->maxPetrolCapacity() ? $this->petrol : $this->maxPetrolCapacity();
        return $this->petrol;
    }

    /**
     * 油箱容量不同
     * @return float 公升
     */
    public abstract function maxPetrolCapacity();


    /**
     * 耗油量不同
     * @return float 公里/公升
     */
    abstract public function kilometersPerLiter();

    public function run(int $kilometers) {
        $liter = $kilometers / $this->kilometersPerLiter();
        if ($liter > $this->petrol) {
            $this->petrol = 0;
            throw new Exception("$this->name is out of petrol");
        }
        $this->petrol -= $liter; 
    }
};

class Car extends Vehicle {
    public function maxPetrolCapacity() { return 40; }
    public function kilometersPerLiter() { return 15; }
};

class Motorcycle extends Vehicle {
    public function maxPetrolCapacity() { return 5; }
    public function kilometersPerLiter() { return 35; }
};


function run(Vehicle $vehicle, float $petrol) {
    echo 'Inject '.$petrol.' liters petrol to '.$vehicle->name.', ';
    echo $vehicle->fillUp($petrol).' liters are injected.<br>';
    try {
        $i = 0;
        while (++$i) {
            echo $vehicle->name.' run '.(($i-1)*100).'~'.(($i)*100).' km...';
            $vehicle->run(100);
            echo 'ok, remain '.sprintf('%.1f', $vehicle->petrolLeft()).' liters petrol.<br>';
        }
    } catch (Exception $e) {
        echo $e->getMessage().'<br>';
    }
}
?>

<html>
    <head>
        <title>一、物件導向 - 繼承/介面</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div>一、物件導向 - 繼承/介面</div>
        <form action="./test_1.php" method="GET">
            <div>
                <label>Vehicle
                    <select name="vehicle">
                        <option>Car</option>
                        <option>Motorcycle</option>
                    </select>
                </label>
            </div>
            <div>
                <label>Petrol:
                    <input type="number" name="petrol" value="10.0"> liters
                </label>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
        <div>
            <?php
                if (isset($_GET['vehicle']) && isset($_GET['petrol'])) {
                    $vehicle = $_GET['vehicle'];
                    $petrol = intval($_GET['petrol']);
                    run(new $vehicle("$vehicle"), $petrol);
                }
            ?>
        </div>
        <script>
            /*<![CDATA[*/
            window.onload = function () {
                const form = document.querySelector('form');
                const vehicle = form.querySelector('[name=vehicle]');
                const petrol = form.querySelector('[name=petrol]');
                form.onsubmit = function (e) {
                    const parsed_petrol = parseInt(petrol.value, 10);
                    if (!Number.isInteger(parsed_petrol)) {
                        alert('petrol value error');
                        return false;
                    }
                    petrol.value = parsed_petrol;
                    form.submit();
                };
                const params = (new URL(location.href)).searchParams;
                if (params.get('vehicle')) {
                    vehicle.value = params.get('vehicle');
                }
                if (params.get('petrol')) {
                    petrol.setAttribute('value', params.get('petrol'));
                }
            }
            /*]]>*/
        </script>
    </body>
</html>
