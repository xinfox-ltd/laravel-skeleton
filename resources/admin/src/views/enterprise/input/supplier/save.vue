<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="600" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" :disabled="mode == 'show'" ref="dialogForm" label-width="100px"
            label-position="right">
            <el-form-item label="供应商名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="联系人" prop="contact">
                <el-input v-model="form.contact" clearable></el-input>
            </el-form-item>
            <el-form-item label="联系电话" prop="telephone">
                <el-input v-model="form.telephone" clearable></el-input>
            </el-form-item>
            <el-form-item label="描述" prop="remark">
                <el-input type="textarea" :rows="3" v-model="form.remark" maxlength="60" placeholder="请输入描述" show-word-limit
                    clearable></el-input>
            </el-form-item>
        </el-form>
        <template #footer>
            <el-button @click="visible = false">取 消</el-button>
            <el-button v-if="mode != 'show'" type="primary" :loading="isSaveing" @click="submit()">保 存</el-button>
        </template>
    </el-dialog>
</template>

<script>
export default {
    emits: ['success', 'closed'],
    data () {
        return {
            mode: "add",
            titleMap: {
                add: '新增供应商',
                edit: '编辑供应商',
                show: '查看'
            },
            visible: false,
            isSaveing: false,
            //表单数据
            form: {
                name: "",
                contact: "",
                telephone: "",
                remark: "",
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入基地名称', trigger: 'change' }
                ],
                contact: [
                    { required: true, message: '请填写联系人' }
                ],
                telephone: [
                    { required: true, message: '请填写联系电话' }
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
                    await this.$API.app.supplier.save.post(this.form)
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
