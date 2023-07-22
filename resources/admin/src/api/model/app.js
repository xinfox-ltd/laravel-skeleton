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
            name: "获取基地列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        },
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
    }
}