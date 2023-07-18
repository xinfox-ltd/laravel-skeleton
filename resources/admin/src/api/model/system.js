import config from "@/config"
import http from "@/utils/request"

export default {
	menu: {
		myMenus: {
			url: `${config.API_URL}/system/menu/my/1.6.1`,
			name: "获取我的菜单",
			get: async function () {
				return await http.get(this.url);
			}
		},
		list: {
			url: `${config.API_URL}/system/menus`,
			name: "获取菜单",
			get: async function () {
				return await http.get(this.url);
			}
		}
	},
}
