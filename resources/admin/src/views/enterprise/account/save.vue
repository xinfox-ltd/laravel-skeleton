<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="650" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">

            <el-form-item label="姓名" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="登录账号" prop="certificate_no">
                <el-input v-model="form.certificate_no" clearable></el-input>
            </el-form-item>
            <el-form-item label="手机号" prop="certificate_no">
                <el-input v-model="form.certificate_no" clearable></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="newPassword">
                <el-input v-model="form.newPassword" type="password" show-password placeholder="请输入新密码"></el-input>
                <sc-password-strength v-model="form.newPassword"></sc-password-strength>
                <div class="el-form-item-msg">请输入包含英文、数字的8位以上密码</div>
            </el-form-item>
            <el-form-item label="确认密码" prop="confirmNewPassword">
                <el-input v-model="form.confirmNewPassword" type="password" show-password placeholder="请再次输入新密码"></el-input>
            </el-form-item>
        </el-form>
        <template #footer>
            <el-button @click="visible = false">取 消</el-button>
            <el-button v-if="mode != 'show'" type="primary" :loading="isSaveing" @click="submit()">保 存</el-button>
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
                show: '查看'
            },
            visible: false,
            isSaveing: false,
            typeOptions: [
                {
                    value: 1,
                    label: '农产品地理标志',
                },
                {
                    value: 4,
                    label: '其他',
                    // disabled: true,
                },
            ],
            //表单数据
            form: {
                name: "",
                type: "",
                certificate_no: "",
                authority: "",
                scan_file: "",
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入证书名称', trigger: 'change' }
                ],
                type: [
                    { required: true, message: '请选择证书类型' }
                ],
                certificate_no: [
                    { required: true, message: '请输入证书编号' }
                ],
                authority: [
                    { required: true, message: '请输入颁发机构' }
                ],
                scan_file: [
                    { required: true, message: '请上传证书扫描件' }
                ],
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
                    await this.$API.app.certificate.save.post(this.form)
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
