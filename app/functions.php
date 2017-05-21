<?php

/**
 * 后台 URL 拼凑
 * @param null $path
 * @param array $parameters
 * @param null $secure
 * @param string $prefix
 * @return string
 */
function admin_url($path = null, $parameters = [], $secure = null, $prefix = 'admin/')
{
    return url($prefix . ltrim($path, '/'), $parameters, $secure);
}

/**
 * http query 模式的 url 拼凑
 * @param $path
 * @param array $query
 * @param null $secure
 * @return string
 */
function query_url($path, $query = [], $secure = null)
{
    return url($path, [], $secure) . '?' . http_build_query($query);
}
