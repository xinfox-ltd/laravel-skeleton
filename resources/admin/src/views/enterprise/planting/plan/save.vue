<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" :disabled="mode == 'show'" ref="dialogForm" label-width="100px"
            label-position="right">
            <el-form-item label="计划名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="基地" prop="production_base_id">
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
            <el-form-item label="产品" prop="supplier_id">
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
            <el-form-item label="负责人" prop="supplier_id">
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
            <el-form-item label="计划结束日期" prop="end_date">
                <el-date-picker v-model="form.end_date" type="date" placeholder="选择一个日期" />
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
                    await this.$API.app.planting.save.post(this.form)
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
