import config from "@/config"
import http from "@/utils/request"

export default {
    company: {
        list: {
            url: `${config.API_URL}/companies`,
            name: "获取企业列表",
            get: async function (params = {}) {
                return await http.get(this.url, params);
            }
        }
    }
}