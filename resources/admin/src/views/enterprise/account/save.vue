<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="450" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="90px" label-position="right">

            <el-form-item label="姓名" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="登录账号" prop="username">
                <el-input v-model="form.username" clearable :disabled="mode == 'edit'"></el-input>
            </el-form-item>
            <el-form-item label="手机号" prop="phone">
                <el-input v-model="form.phone" clearable></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="password" v-if="mode == 'add'">
                <el-input v-model="form.password" type="password" show-password placeholder="请输入新密码"></el-input>
                <sc-password-strength v-model="form.password"></sc-password-strength>
                <div class="el-form-item-msg">请输入包含英文、数字的8位以上密码</div>
            </el-form-item>
            <el-form-item label="确认密码" prop="confirmNewPassword" v-if="mode == 'add'">
                <el-input v-model="form.confirmNewPassword" type="password" show-password placeholder="请再次输入新密码"></el-input>
            </el-form-item>
        </el-form>
        <template #footer>
            <el-button @click="visible = false">取 消</el-button>
            <el-button type="primary" :loading="isSaveing" @click="submit()">保 存</el-button>
        </template>
    </el-dialog>
</template>

<script>
import scPasswordStrength from '@/components/scPasswordStrength'
export default {
    emits: ['success', 'closed'],
    components: {
        scPasswordStrength
    },
    data () {
        return {
            mode: "add",
            titleMap: {
                add: '新增管理账号',
                edit: '编辑管理账号',
            },
            visible: false,
            isSaveing: false,
            //表单数据
            form: {
                name: "",
                username: "",
                phone: "",
                password: "",
                confirmNewPassword: "",
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入管理员姓名', trigger: 'change' }
                ],
                username: [
                    { required: true, message: '请输入登录账号' }
                ],
                phone: [
                    { required: true, message: '请输入手机号' }
                ],
                password: [
                    { required: true, message: '请输入密码' }
                ],
                confirmNewPassword: [
                    { required: true, message: '请再次输入密码' },
                    {
                        validator: (rule, value, callback) => {
                            if (value !== this.form.password) {
                                callback(new Error('两次输入密码不一致'));
                            } else {
                                callback();
                            }
                        }
                    }
                ]
            }
        }
    },
    mounted () {

    },
    methods: {
        //显示
        open (mode = 'add') {
            this.mode = mode;
            this.visible = true;
            return this
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.user.save.post(this.form)
                        .then(res => {
                            this.isSaveing = false;
                            if (res.code == 200) {
                                this.$emit('success')
                                this.visible = false;
                                this.$message.success("操作成功")
                            } else {
                                this.$alert(res.message, "提示", { type: 'error' })
                            }
                        })
                        .catch(() => {
                            this.isSaveing = false;
                        });

                }
            })
        },
        //表单注入数据
        setData (data) {
            Object.assign(this.form, data)
        }
    }
}
</script>

<style></style>
