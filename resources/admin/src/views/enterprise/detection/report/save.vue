<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="650" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="检测报告" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="产品" prop="enterprise_product_id">
                <sc-table-select v-model="product.value" :apiObj="product.apiObj" :params="product.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="product.props"
                    @change="onProductChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="产品名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="产品名称" prop="product_name" width="250"></el-table-column>
                    <el-table-column label="品牌/商标" prop="trademark_name" width="100"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="报告日期" prop="report_date">
                <el-date-picker v-model="form.report_date" type="date" value-format="YYYY-MM-DD" placeholder="选择一个日期" />
            </el-form-item>
            <el-form-item label="检测类型" prop="detection_type">
                <el-input v-model="form.detection_type" clearable></el-input>
            </el-form-item>
            <el-form-item label="检测机构" prop="detection_institution">
                <el-input v-model="form.detection_institution" clearable></el-input>
            </el-form-item>
            <el-form-item label="检测结果" prop="is_qualified">
                <el-radio-group v-model="form.is_qualified">
                    <el-radio :label="1" size="large">合格</el-radio>
                    <el-radio :label="0" size="large">不合格</el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="结果说明" prop="remark">
                <el-input v-model="form.remark" clearable></el-input>
            </el-form-item>
            <el-form-item label="扫描件" prop="scan_file">
                <sc-upload-multiple v-model="form.scan_file" draggable :limit="5"
                    tip="最多上传5个文件,单个文件不要超过10M,请上传图像格式文件"></sc-upload-multiple>
            </el-form-item>
        </el-form>
        <template #footer>
            <el-button @click="visible = false">取 消</el-button>
            <el-button type="primary" :loading="isSaveing" @click="submit()">保 存</el-button>
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
                add: '新增检测报告',
                edit: '编辑检测报告',
            },
            visible: false,
            isSaveing: false,
            product: {
                value: {},
                apiObj: this.$API.app.enterprise.product.list,
                params: {},
                props: {
                    label: 'product_name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            //表单数据
            form: {
                name: "",
                enterprise_product_id: "",
                detection_type: "抽样检测",
                is_qualified: 1,
                remark: "",
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入报告名称', trigger: 'change' }
                ],
                enterprise_product_id: [
                    { required: true, message: '请选择产品', trigger: 'change' }
                ],
                detection_type: [
                    { required: true, message: '请输入检测类型', trigger: 'change' }
                ],
                detection_institution: [
                    { required: true, message: '请输入检测机构', trigger: 'change' }
                ],
                report_date: [
                    { required: true, message: '请选择报告日期', trigger: 'change' }
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
        onProductChange (val) {
            this.form.enterprise_product_id = val.id
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.detectionReport.save.post(this.form)
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
            if (!data.scan_file) {
                this.form.scan_file = "";
            } else {
                this.form.scan_file = data.scan_file.toString();
            }
            this.product.value = {
                id: data.product_id,
                product_name: data.enterprise_product.product.name
            }
        }
    }
}
</script>

<style></style>
