<template>
	<!-- <el-alert title="异步组件动态加载使用了正处于试验阶段的<Suspense>组件, 其API和使用方式可能会改变. <Suspense> is an experimental feature and its API will likely change." type="warning" show-icon style="margin-bottom: 15px;"/> -->

	<el-card shadow="never" header="个人信息">
		<el-form ref="form" :model="form" label-width="120px" style="margin-top:20px;">
			<el-form-item label="账号">
				<el-input v-model="form.username" disabled></el-input>
				<div class="el-form-item-msg">账号信息用于登录，系统不允许修改</div>
			</el-form-item>
			<el-form-item label="姓名">
				<el-input v-model="form.name"></el-input>
			</el-form-item>
			<el-form-item label="手机号">
				<el-input v-model="form.phone"></el-input>
			</el-form-item>
			<el-form-item>
				<el-button type="primary" :loading="submitLoading" @click="submit()">保存</el-button>
			</el-form-item>
		</el-form>
	</el-card>
</template>

<script>
export default {
	data () {
		return {
			form: {
				username: "",
				name: "",
				phone: "",
			},
			submitLoading: false,
		}
	},
	mounted () {
		var userInfo = this.$TOOL.data.get("USER_INFO");
		this.form = userInfo;
	},
	methods: {
		submit () {
			this.submitLoading = true;
			this.$API.app.user.updateSelfInfo.post(this.form)
				.then(res => {
					this.submitLoading = false;
					if (res.code == 200 || res.code == 0) {
						this.$TOOL.data.set("USER_INFO", res.data)
						this.$message.success("操作成功")
					}
				})
				.catch(() => {
					this.submitLoading = false;
				})
		}
	},
}
</script>

<style></style>
