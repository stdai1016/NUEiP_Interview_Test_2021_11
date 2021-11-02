#!/usr/bin/env python3
"""
題目五、邏輯處理 - 交集、差集、聯集
"""


def intersection(arr_a, arr_b):
    """交集"""
    hashmap = {}
    for val in arr_a:
        hashmap[val] = 1
    for val in arr_b:
        if val in hashmap:
            hashmap[val] += 1
    return [val for val in hashmap if hashmap[val] > 1]


def complement(arr_a, arr_b):
    """差集"""
    hashmap = {}
    for val in arr_a:
        hashmap[val] = 1
    for val in arr_b:
        if val in hashmap:
            hashmap[val] = 0
    return [val for val in hashmap if hashmap[val]]


def union(arr_a, arr_b):
    """聯集"""
    hashmap = {}
    for val in arr_a:
        hashmap[val] = 1
    for val in arr_b:
        hashmap[val] = 1
    return hashmap.keys()


if __name__ == '__main__':

    arr_a = [77, 5, 5, 22, 13, 55, 97, 4, 796, 1, 0, 9]
    arr_b = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]

    arr_c = intersection(arr_a, arr_b)
    arr_d = complement(arr_a, arr_b)
    arr_e = union(arr_a, arr_b)

    print(f'5.1 交集： {arr_c}')
    print(f'5.2 差集： {arr_d}')
    print(f'5.3 聯集： {arr_e}')
