<?php

/**
 * 后台 URL 拼凑
 * @param null $path
 * @param array $parameters
 * @param string $prefix
 * @return string
 */
function admin_url($path = null, $parameters = [], $prefix = 'admin/')
{
    return url($prefix . ltrim($path, '/'), $parameters, true);
}

/**
 * http query 模式的 url 拼凑
 * @param $path
 * @param array $query
 * @return string
 */
function query_url($path, $query = [])
{
    return url($path, [], true) . '?' . http_build_query($query);
}
