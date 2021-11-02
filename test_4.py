#!/usr/bin/env python3
"""
題目四、資料排序 - 正序
"""


def sort_numbers(numbers):
    """正序排列"""
    if len(numbers) < 2:
        return numbers
    m = int(len(numbers)/2)
    s1 = sort_numbers(numbers[:m])
    s2 = sort_numbers(numbers[m:])
    sorted_numbers = []
    while s1 and s2:
        if s1[0] < s2[0]:
            sorted_numbers.append(s1.pop(0))
        else:
            sorted_numbers.append(s2.pop(0))
    sorted_numbers.extend(s1)
    sorted_numbers.extend(s2)
    return sorted_numbers


if __name__ == '__main__':

    nums = [77, 5, 5, 22, 13, 55, 97, 4, 796, 1, 0, 9]

    sorted_nums = sort_numbers(nums)

    print(f'4 正序排列： {sorted_nums}')
