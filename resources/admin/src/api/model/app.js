import config from "@/config"
import http from "@/utils/request"

export default {
    user: {
        list: {
            url: `${config.API_URL}/users`,
            name: "获取用户列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/users`,
            name: "保存用户",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
    },
    baseUnit: {
        list: {
            url: `${config.API_URL}/base/units`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/base/units`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
    },
    enterprise: {
        list: {
            url: `${config.API_URL}/enterprises`,
            name: "获取企业列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/enterprises`,
            name: "保存企业",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        product: {
            list: {
                url: `${config.API_URL}/enterprise/products`,
                name: "获取产品列表",
                get: async function (params = {}) {
                    return await http.get(this.url, params);
                }
            },
            save: {
                url: `${config.API_URL}/enterprise/products`,
                name: "保存产品",
                post: async function (data = {}) {
                    return await http.post(this.url, data);
                }
            },
            destroy: {
                url: `${config.API_URL}/enterprise/products/:id`,
                name: "删除",
                delete: async function (id) {
                    return await http.delete(this.url.replace(':id', id));
                }
            }
        },
        staff: {
            list: {
                url: `${config.API_URL}/enterprise/staffs`,
                name: "获取列表",
                get: async function (params = {}) {
                    return await http.get(this.url, params);
                }
            },
            save: {
                url: `${config.API_URL}/enterprise/staffs`,
                name: "保存",
                post: async function (data = {}) {
                    return await http.post(this.url, data);
                }
            },
            del: {
                url: `${config.API_URL}/enterprise/staffs/:id`,
                name: "删除",
                delete: async function (id) {
                    return await http.delete(this.url.replace(':id', id));
                }
            }
        },
    },
    product: {
        list: {
            url: `${config.API_URL}/products`,
            name: "获取产品列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/products`,
            name: "保存产品",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        }
    },
    productionBase: {
        list: {
            url: `${config.API_URL}/bases`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/bases`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        piece: {
            list: {
                url: `${config.API_URL}/base/pieces`,
                name: "获取列表",
                get: async function (params = {}) {
                    return await http.get(this.url, params);
                }
            },
            save: {
                url: `${config.API_URL}/bases/:id/pieces`,
                name: "保存",
                post: async function (id, data = {}) {
                    return await http.post(this.url.replace(':id', id), data);
                }
            },
            clear: {
                url: `${config.API_URL}/bases/:baseid/pieces/:id`,
                name: "删除",
                delete: async function (baseid, id) {
                    return await http.delete(this.url.replace(':baseid', baseid).replace(':id', id));
                }
            },
        }
    },
    dosageForm: {
        list: {
            url: `${config.API_URL}/dosage/forms`,
            name: "获取剂型列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/dosage/forms`,
            name: "保存剂型",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        }
    },
    inputCategory: {
        list: {
            url: `${config.API_URL}/input/categories`,
            name: "获取剂型类别列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/input/categories`,
            name: "保存剂型类别",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        clear: {
            url: `${config.API_URL}/input/categories/:id`,
            name: "删除剂型类别",
            delete: async function (id) {
                return await http.delete(this.url.replace(':id', id));
            }
        }
    },
    traceability: {
        list: {
            url: `${config.API_URL}/traceability/code/applications`,
            name: "获取获取溯源码申请列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
    },
    certificate: {
        list: {
            url: `${config.API_URL}/certificates`,
            name: "获取证书列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/certificates`,
            name: "保存证书",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
    },
    supplier: {
        list: {
            url: `${config.API_URL}/suppliers`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/suppliers`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
    },
    input: {
        list: {
            url: `${config.API_URL}/inputs`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/inputs`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/inputs/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        }
    },
    planting: {
        list: {
            url: `${config.API_URL}/planting/plans`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/planting/plans`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/planting/plans/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        }
    },
    plantingAssignment: {
        list: {
            url: `${config.API_URL}/planting/assignments`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/planting/assignments`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/planting/assignments/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        },
        input: {
            list: {
                url: `${config.API_URL}/planting/assignments/:id/inputs`,
                name: "获取列表",
                get: async function (id, params = {}) {
                    return await http.get(this.url.replace(':id', id), params);
                }
            },
            save: {
                url: `${config.API_URL}/planting/assignments/:id/inputs`,
                name: "保存",
                post: async function (id, data = {}) {
                    return await http.post(this.url.replace(':id', id), data);
                }
            },
            destroy: {
                url: `${config.API_URL}/planting/assignments/:id/inputs/:iid`,
                name: "删除",
                delete: async function (id, iid) {
                    return await http.delete(this.url.replace(':id', id).replace(':iid', iid));
                }
            }
        }
    },
    trademark: {
        list: {
            url: `${config.API_URL}/trademarks`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/trademarks`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/trademarks/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        }
    },
    rawMaterial: {
        list: {
            url: `${config.API_URL}/raw-materials`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/raw-materials`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/raw-materials/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        },
        destroy: {
            url: `${config.API_URL}/raw-materials/:id`,
            name: "删除",
            delete: async function (id) {
                return await http.delete(this.url.replace(":id", id));
            }
        }
    },
    harvestPlan: {
        list: {
            url: `${config.API_URL}/harvest/plans`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/harvest/plans`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/harvest/plans/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        },
        destroy: {
            url: `${config.API_URL}/harvest/plans/:id`,
            name: "删除",
            delete: async function (id) {
                return await http.delete(this.url.replace(":id", id));
            }
        }
    },
    processFlow: {
        list: {
            url: `${config.API_URL}/process/flows`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/process/flows`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/process/flows/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        },
        destroy: {
            url: `${config.API_URL}/process/flows/:id`,
            name: "删除",
            delete: async function (id) {
                return await http.delete(this.url.replace(":id", id));
            }
        }
    },
    process: {
        list: {
            url: `${config.API_URL}/processes`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/processes`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/processes/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        },
        destroy: {
            url: `${config.API_URL}/processes/:id`,
            name: "删除",
            delete: async function (id) {
                return await http.delete(this.url.replace(":id", id));
            }
        }
    },
    package: {
        list: {
            url: `${config.API_URL}/packages`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/packages`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/packages/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        },
        destroy: {
            url: `${config.API_URL}/packages/:id`,
            name: "删除",
            delete: async function (id) {
                return await http.delete(this.url.replace(":id", id));
            }
        }
    },
    detectionReport: {
        list: {
            url: `${config.API_URL}/detection/reports`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/detection/reports`,
            name: "保存",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        info: {
            url: `${config.API_URL}/detection/reports/:id`,
            name: "单个详情",
            get: async function (id) {
                return await http.get(this.url.replace(":id", id));
            }
        },
        destroy: {
            url: `${config.API_URL}/detection/reports/:id`,
            name: "删除",
            delete: async function (id) {
                return await http.delete(this.url.replace(":id", id));
            }
        }
    },
    traceabilityCode: {
        applyfor: {
            list: {
                url: `${config.API_URL}/traceability/code/applications`,
                name: "获取列表",
                get: async function (params = {}) {
                    return await http.get(this.url, params);
                }
            },
            save: {
                url: `${config.API_URL}/traceability/code/applications`,
                name: "保存",
                post: async function (data = {}) {
                    return await http.post(this.url, data);
                }
            },
            info: {
                url: `${config.API_URL}/traceability/code/applications/:id`,
                get: async function (id) {
                    return await http.get(this.url.replace(":id", id));
                }
            },
            destroy: {
                url: `${config.API_URL}/traceability/code/applications/:id`,
                name: "删除",
                delete: async function (id) {
                    return await http.delete(this.url.replace(":id", id));
                }
            },
            handle: {
                url: `${config.API_URL}/traceability/code/applications/:id/handle`,
                name: "处理",
                post: async function (id, data = {}) {
                    return await http.post(this.url.replace(':id', id), data);
                }
            }
        },
        list: {
            url: `${config.API_URL}/traceability/codes`,
            name: "获取列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
        save: {
            url: `${config.API_URL}/traceability/codes`,
            name: "编辑",
            post: async function (data = {}) {
                return await http.post(this.url, data);
            }
        },
        operate: {
            url: `${config.API_URL}/traceability/codes/:id/operate`,
            name: "操作",
            post: async function (id, data = {}) {
                return await http.post(this.url.replace(':id', id), data);
            }
        },
    }
}