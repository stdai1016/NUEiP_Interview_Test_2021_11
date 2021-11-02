#!/usr/bin/env python3
"""
二、資料處理 - 字串
"""

import re


def cvt_halfwidth_colon_to_fullwidth_colon(string):
    """將半型冒號改為全型冒號"""
    return re.sub(r':', '：', string)


def remove_spaces_between_chinese(string):
    """去除中文字間的空白"""
    char_codes = []
    spaces = []
    for i in range(len(string)):
        c = ord(string[i])
        if c == 32:
            spaces.append(c)
        elif c <= 255:
            char_codes.extend(spaces)
            spaces = []
            char_codes.append(c)
        else:
            if not len(char_codes) or char_codes[-1] <= 255:
                char_codes.extend(spaces)
            spaces = []
            char_codes.append(c)

    char_codes.extend(spaces)
    return ''.join([chr(c) for c in char_codes])


def get_substr_between_chars(string, start, end):
    """返回指定字元之間的字串"""
    try:
        start = string.index(start)
        string = string[start+1:]
    except:
        return ''
    try:
        end = string.index(end)
        string = string[:end]
    except:
        pass
    return string


if __name__ == '__main__':

    str_given = '人易科技:上 機 測 驗 - 演算法'

    str_1 = cvt_halfwidth_colon_to_fullwidth_colon(str_given)
    str_2 = remove_spaces_between_chinese(str_1)
    str_3 = get_substr_between_chars(str_2, '：', '-')

    print(f'2.1 半型冒號改全型    ："{str_1}"')
    print(f'2.2 去除中文字間的空白："{str_2}"')
    print(f'2.3 "：" 到 "-" 之間  ："{str_3}"')
