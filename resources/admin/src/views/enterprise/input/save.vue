<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="投入品名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="类别" prop="input_category_id">
                <el-select v-model="form.input_category_id" clearable placeholder="请选择" @change="onTypeChange">
                    <el-option v-for="item in inputCategoryOptions" :key="item.id" :label="item.name" :value="item.id" />
                </el-select>
            </el-form-item>
            <el-form-item label="剂型" prop="dosage_form_id" v-if="form.type">
                <sc-table-select v-model="dosageForm.value" :apiObj="dosageForm.apiObj" :params="dosageForm.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="dosageForm.props"
                    @change="onDosageFormChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="剂型名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="剂型名称" prop="name" width="200"></el-table-column>
                    <el-table-column label="投入品类别" prop="category.name" width="120"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="供应商" prop="supplier_id">
                <sc-table-select v-model="supplier.value" :apiObj="supplier.apiObj" :params="supplier.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="supplier.props"
                    @change="onSupplierChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="供应商名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="供应商名称" prop="name" width="250"></el-table-column>
                    <el-table-column label="联系人" prop="contact" width="100"></el-table-column>
                    <el-table-column label="联系电话" prop="telephone" width="120"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
                <div class="el-form-item-msg">没有供应商就是自制</div>
            </el-form-item>
            <el-form-item label="生产企业" prop="enterprise">
                <el-input v-model="form.enterprise" clearable></el-input>
            </el-form-item>
            <el-form-item label="登记证号" prop="registration_no">
                <el-input v-model="form.registration_no" clearable></el-input>
            </el-form-item>

            <el-form-item label="成分信息" prop="component">
                <el-input type="textarea" :rows="3" v-model="form.component" maxlength="60" placeholder="请输入企业地址"
                    show-word-limit clearable></el-input>
            </el-form-item>
            <el-form-item label="执行标准" prop="executive_standard">
                <el-input type="executive_standard" :rows="3" v-model="form.address" maxlength="60" placeholder="请输入企业地址"
                    show-word-limit clearable></el-input>
            </el-form-item>
            <el-form-item label="附件" prop="annex">
                <sc-upload-file v-model="form.annex" :limit="3" tip="最多上传3个文件,单个文件不要超过10M">
                    <el-button type="primary" icon="el-icon-upload">上传附件</el-button>
                </sc-upload-file>
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
                add: '新增投入品',
                edit: '编辑投入品',
                show: '查看'
            },
            visible: false,
            isSaveing: false,
            inputCategoryOptions: [],
            dosageForm: {
                value: {},
                apiObj: this.$API.app.dosageForm.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            supplier: {
                value: {},
                apiObj: this.$API.app.supplier.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            //表单数据
            form: {
                id: 0,
                name: "",
                input_category_id: "",
                dosage_form_id: "",
                supplier_id: "",
                enterprise: "",
                registration_no: "",
                component: "",
                executive_standard: "",
                annex: ""
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入投入品名称', trigger: 'change' }
                ],
                input_category_id: [
                    { required: true, message: '请选择投入品类别' }
                ],
                dosage_form_id: [
                    { required: true, message: '请选择剂型' }
                ],
            }
        }
    },
    mounted () {
        this.getInputCategoryOptions();
    },
    methods: {
        //显示
        open (mode = 'add') {
            this.mode = mode;
            this.visible = true;
            return this
        },
        getInputCategoryOptions () {
            this.$API.app.inputCategory.list.get({ pagination: false })
                .then(res => {
                    this.inputCategoryOptions = res.data.rows
                })
        },
        onTypeChange (val) {
            this.form.type = val
            this.dosageForm.params = Object.assign(this.dosageForm.params, { category_id: val })
            console.log(this.dosageForm.params);
        },
        onDosageFormChange (val) {
            console.log(val);
            this.form.dosage_form_id = val.id
        },
        onSupplierChange (val) {
            this.form.supplier_id = val.id
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.input.save.post(this.form)
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
            if (data.supplier) {
                this.supplier.value = data.supplier
            }
        }
    }
}
</script>

<style></style>
