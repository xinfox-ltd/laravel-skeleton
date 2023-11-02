<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="650" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="120px" label-position="right">

            <el-form-item label="认证类型" prop="type">
                <el-select v-model="form.type" placeholder="请选择认证类型">
                    <el-option v-for="item in typeOptions" :key="item.value" :label="item.label" :value="item.value"
                        :disabled="item.disabled" />
                </el-select>
            </el-form-item>
            <el-form-item label="产品认证类型" prop="subtype" v-if="form.type == 3">
                <el-select v-model="form.subtype" placeholder="请选择">
                    <el-option v-for="item in subtypeOptions" :key="item.value" :label="item.label" :value="item.value"
                        :disabled="item.disabled" />
                </el-select>
            </el-form-item>
            <el-form-item label="证书名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="证书编号" prop="certificate_no">
                <el-input v-model="form.certificate_no" clearable></el-input>
            </el-form-item>
            <el-form-item label="颁证机构" prop="authority">
                <el-input v-model="form.authority" clearable></el-input>
            </el-form-item>
            <el-form-item label="有效期" prop="valid_date">
                <el-date-picker v-model="form.valid_date" type="daterange" range-separator="到" start-placeholder="开始日期"
                    end-placeholder="结束日期" value-format="YYYY-MM-DD" />
            </el-form-item>
            <el-form-item label="扫描件" prop="scan_file">
                <sc-upload-multiple v-model="form.scan_file" draggable :limit="5"
                    tip="最多上传5个文件,单个文件不要超过10M,请上传图像格式文件"></sc-upload-multiple>
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
                add: '新增',
                edit: '编辑',
                show: '查看'
            },
            visible: false,
            isSaveing: false,
            typeOptions: [
                {
                    value: 3,
                    label: '产品认证',
                },
                {
                    value: 2,
                    label: '企业资质',
                    // disabled: true,
                },
            ],
            subtypeOptions: [
                {
                    value: 1,
                    label: '无公害农产品',
                },
                {
                    value: 2,
                    label: '绿色食品',
                    // disabled: true,
                },
                {
                    value: 3,
                    label: '有机农产品',
                    // disabled: true,
                },
                {
                    value: 4,
                    label: '富硒农产品',
                    // disabled: true,
                },
                {
                    value: 5,
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
                subtype: [
                    { required: true, message: '请选择产品证书类型' }
                ],
                certificate_no: [
                    { required: true, message: '请输入证书编号' }
                ],
                valid_date: [
                    { required: true, message: '请选择有效期' }
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
