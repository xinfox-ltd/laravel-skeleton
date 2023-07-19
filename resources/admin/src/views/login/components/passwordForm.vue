<template>
	<el-form ref="loginForm" :model="form" :rules="rules" label-width="0" size="large" @keyup.enter="login">
		<el-form-item prop="user">
			<el-input v-model="form.user" prefix-icon="el-icon-user" clearable :placeholder="$t('login.userPlaceholder')">
			</el-input>
		</el-form-item>
		<el-form-item prop="password">
			<el-input v-model="form.password" prefix-icon="el-icon-lock" clearable show-password
				:placeholder="$t('login.PWPlaceholder')"></el-input>
		</el-form-item>
		<!-- <el-form-item style="margin-bottom: 10px;">
			<el-col :span="12">
				<el-checkbox :label="$t('login.rememberMe')" v-model="form.autologin"></el-checkbox>
			</el-col>
			<el-col :span="12" class="login-forgot">
				<router-link to="/reset_password">{{ $t('login.forgetPassword') }}？</router-link>
			</el-col>
		</el-form-item> -->
		<el-form-item>
			<el-button type="primary" style="width: 100%;" :loading="islogin" round @click="login">{{ $t('login.signIn')
			}}</el-button>
		</el-form-item>
		<!-- <div class="login-reg">
			{{ $t('login.noAccount') }} <router-link to="/user_register">{{ $t('login.createAccount') }}</router-link>
		</div> -->
	</el-form>
</template>

<script>
export default {
	data () {
		return {
			userType: 'admin',
			form: {
				user: "admin",
				password: "123456",
				autologin: false
			},
			rules: {
				user: [
					{ required: true, message: this.$t('login.userError'), trigger: 'blur' }
				],
				password: [
					{ required: true, message: this.$t('login.PWError'), trigger: 'blur' }
				]
			},
			islogin: false,
		}
	},
	mounted () {

	},
	methods: {
		async login () {

			var validate = await this.$refs.loginForm.validate().catch(() => { })
			if (!validate) { return false }

			this.islogin = true
			var data = {
				username: this.form.user,
				password: this.form.password,
				login_method: "account_password",
			}
			//获取token
			await this.$API.auth.token.post(data)
				.then(async user => {
					console.log(user)
					if (user.code == 200) {
						console.log(user.data);
						const token = user.data.token
						this.$TOOL.cookie.set("TOKEN", token.token, {
							expires: token.expires_in
						})
						this.$TOOL.data.set("USER_INFO", user.data.user)

						//获取菜单
						var menu = await this.$API.system.menu.list.get().catch(() => { this.islogin = false })
						if (menu.code == 200) {
							if (menu.data.menu.length == 0) {
								this.islogin = false
								this.$alert("当前用户无任何菜单权限，请联系系统管理员", "无权限访问", {
									type: 'error',
									center: true
								})
								return false
							}
							this.$TOOL.data.set("MENU", menu.data.menu)
							this.$TOOL.data.set("PERMISSIONS", menu.data.permissions)
							this.$TOOL.data.set("DASHBOARDGRID", menu.data.dashboardGrid)
						} else {
							this.islogin = false
							this.$message.warning(menu.message)
							return false
						}

						this.$router.replace({
							path: '/'
						})
						this.$message.success("登录成功")
						this.islogin = false

					} else {
						this.islogin = false
						this.$message.warning(user.message)
						return false
					}
				})
				.catch(() => { this.islogin = false })


		},
	}
}
</script>

<style></style>
