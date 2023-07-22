<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="650" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">

            <el-form-item label="企业" prop="type">
                <el-select v-model="form.type" placeholder="请选择企业类型">
                    <el-option v-for="item in typeOptions" :key="item.value" :label="item.label" :value="item.value"
                        :disabled="item.disabled" />
                </el-select>
            </el-form-item>
            <el-form-item label="产品" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="编号" prop="certificate_no">
                <el-input v-model="form.certificate_no" clearable></el-input>
            </el-form-item>
            <el-form-item label="有效期" prop="authority">
                <el-input v-model="form.authority" clearable></el-input>
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
                add: '新增认证证书',
                edit: '编辑认证证书',
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
            var scanFile = "";
            if (data.scan_file && Array.isArray(data.scan_file)) {
                scanFile = data.scan_file.toString();
            }
            Object.assign(this.form, data)
            this.form.scan_file = scanFile;
        }
    }
}
</script>

<style></style>
