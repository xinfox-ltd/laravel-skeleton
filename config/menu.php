<?php

/**
 * Copyright (c) 2023 Moonstone. All rights reserved.
 */
declare(strict_types=1);

return [
    [
        "name" => "home",
        "path" => "/home",
        "meta" => [
            "title" => "首页",
            "icon" => "el-icon-home-filled",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "dashboard",
                "path" => "/dashboard",
                "meta" => [
                    "title" => "控制台",
//                    "icon" => "el-icon-menu",
                    "affix" => true
                ],
                "component" => "home"
            ],
            [
                "name" => "userCenter",
                "path" => "/usercenter",
                "meta" => [
                    "title" => "帐号信息",
//                    "icon" => "el-icon-user",
//                    "tag" => "NEW"
                ],
                "component" => "userCenter"
            ],
        ]
    ],
    [
        "name" => "companyManage",
        "path" => "/company",
        "meta" => [
            "title" => "企业管理",
            "icon" => "el-icon-document",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "companyList",
                "path" => "/company/list",
                "meta" => [
                    "title" => "企业列表",
//                    "icon" => "el-icon-office-building",
                    "affix" => false
                ],
                "component" => "company"
            ],
        ]
    ],
    [
        "name" => "productManage",
        "path" => "/product",
        "meta" => [
            "title" => "产品管理",
            "icon" => "el-icon-collection",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "productList",
                "path" => "/product/list",
                "meta" => [
                    "title" => "产品列表",
//                    "icon" => "el-icon-finished",
                    "affix" => false
                ],
                "component" => "product"
            ],
        ]
    ],
    [
        "name" => "productionBaseManage",
        "path" => "/production/base",
        "meta" => [
            "title" => "生产基地",
            "icon" => "el-icon-connection",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "productionBaseList",
                "path" => "/production-base/list",
                "meta" => [
                    "title" => "基地列表",
//                    "icon" => "el-icon-cpu",
//                    "tag" => "NEW"
                ],
                "component" => "productionBase"
            ],
        ]
    ],
    [
        "name" => "authentication",
        "path" => "/authentication",
        "meta" => [
            "title" => "认证管理",
            "icon" => "el-icon-hot-water",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "certificateList",
                "path" => "/certificate/list",
                "meta" => [
                    "title" => "证书列表",
                    "affix" => false
                ],
                "component" => "authentication/certificate"
            ],
        ]
    ],
    [
        "name" => "traceabilityCodeManage",
        "path" => "/traceability-code",
        "meta" => [
            "title" => "溯源码管理",
            "icon" => "el-icon-money",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "applicationList",
                "path" => "/traceability-code/application/list",
                "meta" => [
                    "title" => "申请列表",
                    //"icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "traceabilityCode/application"
            ],
            [
                "name" => "traceabilityCodeList",
                "path" => "/traceability-code/list",
                "meta" => [
                    "title" => "溯源码管理",
                    //"icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "traceabilityCode/list"
            ],
            [
                "name" => "traceabilityCodeStat",
                "path" => "/traceability-code/stat",
                "meta" => [
                    "title" => "使用统计",
                    //"icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "traceabilityCode/stat"
            ],
            [
                "name" => "traceabilityCodeStat",
                "path" => "/traceability-code/stat",
                "meta" => [
                    "title" => "使用统计（产品）",
                    //"icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "traceabilityCode/stat"
            ],
        ]
    ],
    [
        "name" => "basicDataManage",
        "path" => "/basic-data",
        "meta" => [
            "title" => "基础数据",
            "icon" => "el-icon-hot-water",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "standardList",
                "path" => "/basic-data/standard/list",
                "meta" => [
                    "title" => "企业农资标准库",
                    "affix" => false
                ],
                "component" => "basicData/standard"
            ],
            [
                "name" => "unitOfMeasurementList",
                "path" => "/basic-data/unit2measurement/list",
                "meta" => [
                    "title" => "计量单位",
                    "affix" => false
                ],
                "component" => "basicData/unit2measurement"
            ],
            [
                "name" => "dosageFormList",
                "path" => "/basic-data/dosage-form/list",
                "meta" => [
                    "title" => "剂型管理",
                    "affix" => false
                ],
                "component" => "basicData/dosageForm"
            ],
        ]
    ],
    [
        "name" => "system",
        "path" => "/system",
        "meta" => [
            "title" => "系统",
            "icon" => "el-icon-setting",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "setting",
                "path" => "/setting",
                "meta" => [
                    "title" => "系统设置",
                    "affix" => false
                ],
                "component" => "setting/system"
            ],
            [
                "name" => "staffList",
                "path" => "/staff/list",
                "meta" => [
                    "title" => "员工管理",
//                    "icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "setting/staff"
            ],
            [
                "name" => "departmentList",
                "path" => "/department/list",
                "meta" => [
                    "title" => "部门管理",
//                    "icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "setting/dept"
            ],
        ]
    ]
];
