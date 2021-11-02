#!/usr/bin/env python3
"""
題目三、資料處理 - 陣列
"""


def minus_sum_of_array(nums1, nums2):
    """ 返回將陣列總和減去另一陣列總和之值
    @param `nums1`
    @param `nums2`
    @return 
    """
    return sum(nums1) - sum(nums2)
    

def separate_numbers_by_parity(numbers):
    """ 將數字陣列分割成偶數和奇數陣列並返回
    @param `list` `numbers`
    @return `tuple[list, list]` two list contain even numbers and odd numbers respectively
    """
    even = []
    odd = []
    for val in numbers:
        if val % 2:
            odd.append(val)
        else:
            even.append(val)

    return even, odd


if __name__ == '__main__':

    nums = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]

    even_nums, odd_nums = separate_numbers_by_parity(nums)

    diff = minus_sum_of_array(odd_nums, even_nums)

    print(f'3.1 奇數總和減去偶數總和： {diff}')
    print('3.2 分割陣列')
    print(f'\t 偶數值陣列： {even_nums}')
    print(f'\t 奇數值陣列： {odd_nums}')
