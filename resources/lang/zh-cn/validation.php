<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => '请勾选 :attribute ',
    'active_url'           => ' :attribute 不是一个合法的网址',
    'after'                => ' :attribute 必须是一个 :date 之后的日期',
    'alpha'                => ' :attribute 只能包含字母',
    'alpha_dash'           => ' :attribute 只能包含字母、数字和下划线',
    'alpha_num'            => ' :attribute 只能包含字母和数字',
    'array'                => ' :attribute 只能是一个集合',
    'before'               => ' :attribute 必须是一个 :date 之前的日期',
    'between'              => [
        'numeric' => ' :attribute 必须在 :min 到 :max 之间',
        'file'    => ' :attribute 必须在 :min KB 到 :max KB 之间',
        'string'  => ' :attribute 必须在 :min 个字符到 :max 个字节之间',
        'array'   => ' :attribute 必须包含 :min 到 :max 个元素',
    ],
    'boolean'              => ' :attribute 只能是 "是" 或者 "不是"',
    'confirmed'            => ' :attribute 确认不匹配',
    'date'                 => ' :attribute 不是一个合法的日期',
    'date_format'          => ' :attribute 不符合 :format 格式',
    'different'            => ' :attribute 与 :or 必须不相同',
    'digits'               => ' :attribute 必须是 :digits 数字',
    'digits_between'       => ' :attribute 必须是 :min 之间 :max 的数字',
    'email'                => ' :attribute 必须是一个合法的 Email 地址',
    'exists'               => ' 选项 :attribute 无效',
    'filled'               => '缺少 :attribute 参数',
    'image'                => ' :attribute 必须是图片',
    'in'                   => ' 选项 :attribute 无效',
    'integer'              => ' :attribute 必须是整数',
    'ip'                   => ' :attribute 必须是一个IP地址',
    'json'                 => ' :attribute 必须是一个 JSON 字符串',
    'max'                  => [
        'numeric' => ' :attribute 不能大于 :max ',
        'file'    => ' :attribute 不能大于 :max KB ',
        'string'  => ' :attribute 不能大于 :max 个字节',
        'array'   => ' :attribute 不能多于 :max 个元素',
    ],
    'mimes'                => ' :attribute 必须是类型: :values.',
    'min'                  => [
        'numeric' => ' :attribute 至少大于 :min',
        'file'    => ' :attribute 至少大于 :min KB',
        'string'  => ' :attribute 至少大于 :min 个字节',
        'array'   => ' :attribute 至少大于 :min 个元素',
    ],
    'not_in'               => '选定的 :attribute 不正确',
    'numeric'              => ' :attribute 必须是一个数字',
    'regex'                => ' :attribute 格式不符',
    'required'             => ' :attribute 是必填项',
    'required_if'          => '当 :or 是 :value , :attribute 是必填项',
    'required_unless'      => ' :attribute 是必填项, 除非 :or 在 :values 当中',
    'required_with'        => '当 :values 存在时, :attribute 是必填项',
    'required_with_all'    => '当 :values 存在时, :attribute 是必填项 ',
    'required_without'     => '当 :values 不存在时, :attribute 是必填项',
    'required_without_all' => '当 :values 都不存在时, :attribute 是必填项',
    'same'                 => ' :attribute 和 :or 必须相同',
    'size'                 => [
        'numeric' => ' :attribute 必须是 :size',
        'file'    => ' :attribute 必须是 :size KB',
        'string'  => ' :attribute 必须是 :size 个字节',
        'array'   => ' :attribute 必须包含 :size 个元素',
    ],
    'string'               => ' :attribute 必须是一个字符',
    'timezone'             => ' :attribute 必须是一个时间区间',
    'unique'               => ' :attribute 已经被使用',
    'url'                  => ' :attribute 不是一个网址',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'email' => trans('auth.email'),
        'name' => trans('auth.name'),
        'password' => trans('auth.password'),
        'terms' => trans('auth.terms'),
        'description' => trans('common.description'),
        'mobile' => trans('common.mobile'),
        'sex' => trans('common.sex'),
        'role_display_name' => trans('admin.role.display_name'),
        'role_description' => trans('admin.role.description'),
        'role_name' => trans('admin.role.name'),
        'permission_display_name' => trans('admin.permission.display_name'),
        'permission_description' => trans('admin.permission.description'),
        'permission_name' => trans('admin.permission.name'),
        'oauth_scope_description' => trans('common.oauth_scope_description'),
        'oauth_scope_id' => trans('common.oauth_scope_id'),
        'oauth_client_scope' => trans('common.oauth_client_scope'),
        'oauth_client_grant' => trans('common.oauth_client_grant'),
        'oauth_client_redirect_uri' => trans('common.oauth_client_redirect_uri'),
        'original_password' => trans('auth.original_password'),
    ],

];
