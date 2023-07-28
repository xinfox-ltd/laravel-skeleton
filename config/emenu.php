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
            "icon" => "el-icon-house",
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
        "name" => "baseManage",
        "path" => "/enterprise/base",
        "meta" => [
            "title" => "基地管理",
            "icon" => "el-icon-map-location",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "baseList",
                "path" => "/enterprise/base/list",
                "meta" => [
                    "title" => "基地列表",
//                    "icon" => "el-icon-office-building",
                    "affix" => false
                ],
                "component" => "enterprise/base"
            ],
        ]
    ],
    [
        "name" => "inputManage",
        "path" => "/enterprise/input",
        "meta" => [
            "title" => "投入品管理",
            "icon" => "el-icon-takeaway-box",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "inputSupplierList",
                "path" => "/enterprise/input/supplier/list",
                "meta" => [
                    "title" => "供应商管理",
//                    "icon" => "el-icon-finished",
                    "affix" => false
                ],
                "component" => "enterprise/input/supplier"
            ],
            [
                "name" => "inputList",
                "path" => "/enterprise/input/list",
                "meta" => [
                    "title" => "投入品列表",
//                    "icon" => "el-icon-finished",
                    "affix" => false
                ],
                "component" => "enterprise/input"
            ],
        ]
    ],
    [
        "name" => "plantingManage",
        "path" => "/enterprise/planting",
        "meta" => [
            "title" => "种植管理",
            "icon" => "el-icon-map-location",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "plantingPlanList",
                "path" => "/enterprise/planting/plan/list",
                "meta" => [
                    "title" => "种植计划",
//                    "icon" => "el-icon-cpu",
//                    "tag" => "NEW"
                ],
                "component" => "enterprise/planting/plan"
            ],
            [
                "name" => "farmingAssignmentList",
                "path" => "/enterprise/planting/assignment/list",
                "meta" => [
                    "title" => "农事作业",
//                    "icon" => "el-icon-cpu",
//                    "tag" => "NEW"
                ],
                "component" => "enterprise/planting/assignment"
            ],
        ]
    ],
    [
        "name" => "rawMaterialManage",
        "path" => "/enterprise/raw-material",
        "meta" => [
            "title" => "原料管理",
            "icon" => "el-icon-document-checked",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "rawMaterialList",
                "path" => "/certificate/raw-material/list",
                "meta" => [
                    "title" => "原料列表",
                    "affix" => false
                ],
                "component" => "certificate/rawMaterial"
            ],
            [
                "name" => "harvestPlanList",
                "path" => "/certificate/raw-material/harvest/list",
                "meta" => [
                    "title" => "采收计划",
                    "affix" => false
                ],
                "component" => "certificate/rawMaterial/harvest"
            ],
        ]
    ],
    [
        "name" => "processingManage",
        "path" => "/certificate/processing",
        "meta" => [
            "title" => "加工管理",
            "icon" => "el-icon-postcard",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "processingWorkflowList",
                "path" => "/certificate/processing/workflow/list",
                "meta" => [
                    "title" => "加工流程",
                    //"icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "certificate/processing/workflow"
            ],
            [
                "name" => "processingTypeList",
                "path" => "/certificate/processing/type/list",
                "meta" => [
                    "title" => "加工类型",
                    //"icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "certificate/processing/type"
            ],
            [
                "name" => "processingPackageList",
                "path" => "/certificate/package/list",
                "meta" => [
                    "title" => "包装规格",
                    //"icon" => "el-icon-menu",
                    "affix" => false
                ],
                "component" => "certificate/processing/package"
            ],
        ]
    ],
    [
        "name" => "detectionManage",
        "path" => "/certificate/detection",
        "meta" => [
            "title" => "检测管理",
            "icon" => "el-icon-cpu",
            "type" => "menu"
        ],
        "children" => [
            [
                "name" => "detectionList",
                "path" => "/certificate/detection/list",
                "meta" => [
                    "title" => "检测报告",
                    "affix" => false
                ],
                "component" => "certificate/detection"
            ],
        ]
    ],
];
