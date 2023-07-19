import config from "@/config"
import http from "@/utils/request"

export default {
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
        }
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
    }
}