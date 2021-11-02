<?php
/**
 * @param int[] $nums
 * @param int $target
 * @return int[] index of 
 */
function twoSum(array $nums, int $target) {
    $o = $target % 2;
    $target = ($target - $o) / 2;
    $dmap = [];
    foreach($nums as $k => $v) {
        $v -= $target;
        if ($v > 0 && $o) $v -= 1;
        if (isset($dmap[$v])){
            $dmap[$v][] = $k;
        } else {
            $dmap[$v] = [$k];
        };
    }

    $keys = array_keys($dmap);
    sort($keys);
    foreach($keys as $d) {
        if ($d > 0) break;
        else if ($d == 0) {
            if (count($dmap[$d]) > 1) return $dmap[$d];
        }
        else if (isset($dmap[-$d])) {
            return [$dmap[$d][0], $dmap[-$d][0]];
        }
    }
    return [];
}


$result = '';
if (isset($_GET['nums']) && isset($_GET['target'])) {
    $nums = array_map('intval', explode(',', $_GET['nums']));
    $target = intval($_GET['target']);
    $result = twoSum($nums, $target);
    $result = '['.implode(', ', $result).']';
}
?>

<html>
    <head>
        <title>六、兩數總和</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div>Two Sum</div>
        <form action="./test_6.php" method="GET">
            <div>
                <label>nums [<input name="nums" value="2,7,11,15">]</label>
            </div>
            <div>
                <label>target <input type="number" name="target" value="9"></label>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>
        <div><?php echo $result ?></div>
        <script>
            /*<![CDATA[*/
            window.onload = function () {
                const form = document.querySelector('form');
                const nums = form.querySelector('input[name=nums]');
                const target = form.querySelector('input[name=target]');
                form.onsubmit = function (e) {
                    const parsed_nums = [];
                    for (let v of nums.value.split(',')) {
                        v = parseInt(v, 10);
                        if (!Number.isInteger(v)) {
                            alert('nums value error');
                            return false;
                        }
                        parsed_nums.push(v);
                    }
                    nums.value = parsed_nums.join(',');
                    const parsed_target = parseInt(target.value, 10);
                    if (!Number.isInteger(parsed_target)) {
                        alert('target value error');
                        return false;
                    }
                    target.value = parsed_target;
                    parseInt(target.value)
                    form.submit();
                };
                const params = (new URL(location.href)).searchParams;
                if (params.get('nums')) {
                   nums.setAttribute('value', params.get('nums'));
                }
                if (params.get('target')) {
                    target.setAttribute('value', params.get('target'));
                }
            }
            /*]]>*/
        </script>
    </body>
</html>
