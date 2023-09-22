<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="600" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="120px" label-position="right">
            <el-form-item label="有效期" prop="effective_day">
                <el-input-number v-model="form.effective_day" :min="1" :max="999" />
            </el-form-item>
            <el-form-item label="采收计划" prop="harvest_plan_id">
                <sc-table-select v-model="harvestPlan.value" :apiObj="harvestPlan.apiObj" :params="harvestPlan.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="harvestPlan.props"
                    @change="onHarvestPlan">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="计划名称" prop="name" width="150"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="种植地块" prop="production_base_item_id">
                <el-select v-model="form.production_base_item_id" placeholder="选择种植地块">
                    <el-option v-for="item in basePieces" :key="item.id" :label="item.name" :value="item.id" />
                </el-select>
            </el-form-item>
            <el-form-item label="加工类型" prop="process_id">
                <sc-table-select v-model="processingType.value" :apiObj="processingType.apiObj"
                    :params="processingType.params" :table-width="700" clearable collapse-tags collapse-tags-tooltip
                    :props="processingType.props" @change="onProcessingType">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="加工类型名称" prop="name" width="150"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-row>
                <el-col :span="12">
                    <el-form-item label="开始加工日期" prop="valid_date">
                        <el-date-picker v-model="form.valid_date" type="date" placeholder="结束日期"
                            value-format="YYYY-MM-DD" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item label="结束加工日期" prop="process_end_date">
                        <el-date-picker v-model="form.process_end_date" type="date" placeholder="结束日期"
                            value-format="YYYY-MM-DD" />
                    </el-form-item></el-col>
            </el-row>
            <el-form-item label="产品" prop="enterprise_product_id">
                <sc-table-select v-model="product.value" :apiObj="product.apiObj" :params="product.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="product.props"
                    @change="onProductChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="产品名称" prop="product_name" width="150"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="外包装规格" prop="package_id">
                <sc-table-select v-model="productPackage.value" :apiObj="productPackage.apiObj"
                    :params="productPackage.params" :table-width="700" clearable collapse-tags collapse-tags-tooltip
                    :props="productPackage.props" @change="onPackageChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="外包装规格名称" prop="name" width="150"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="检测报告" prop="report_id">
                <sc-table-select v-model="detectionReport.value" :apiObj="detectionReport.apiObj"
                    :params="detectionReport.params" :table-width="700" clearable collapse-tags collapse-tags-tooltip
                    :props="detectionReport.props" @change="onReportChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="计划" prop="name" width="150"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
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
                add: '新增',
                edit: '编辑',
            },
            visible: false,
            isSaveing: false,
            harvestPlan: {
                value: {},
                apiObj: this.$API.app.harvestPlan.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            processingType: {
                value: {},
                apiObj: this.$API.app.process.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            detectionReport: {
                value: {},
                apiObj: this.$API.app.detectionReport.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            productPackage: {
                value: {},
                apiObj: this.$API.app.package.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
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
            basePieces: [],
            //表单数据
            form: {
                effective_day: 0,
                harvest_plan_id: 0,
                report_id: 0,
                package_id: 0,
                process_id: 0,
            },
            //验证规则
            rules: {
                effective_day: [
                    { required: true, message: '请输入证书名称', trigger: 'change' }
                ],
                harvest_plan_id: [
                    { required: true, message: '请选择采收计划', trigger: 'change' }
                ],
                package_id: [
                    { required: true, message: '请选择外包装规格', trigger: 'change' }
                ],
                process_id: [
                    { required: true, message: '请选择加工类型', trigger: 'change' }
                ],
                enterprise_product_id: [
                    { required: true, message: '请选择产品', trigger: 'change' }
                ],
                process_end_date: [
                    { required: true, message: '请填写结束加工日期', trigger: 'change' }
                ]
            }
        }
    },
    mounted () {
        this.getProductionBasePieceList();
    },
    methods: {
        //显示
        open (mode = 'add') {
            this.mode = mode;
            this.visible = true;
            return this
        },
        onHarvestPlan (val) {
            this.form.harvest_plan_id = val.id
        },
        onReportChange (val) {
            this.form.report_id = val.id
        },
        onPackageChange (val) {
            this.form.package_id = val.id
        },
        onProcessingType (val) {
            this.form.process_id = val.id
        },
        onProductChange (val) {
            this.form.enterprise_product_id = val.id
        },
        getProductionBasePieceList () {
            this.$API.app.productionBase.piece.list.get()
                .then(res => {
                    this.basePieces = res.data
                })
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.traceabilityCode.save.post(this.form)
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
            if (data.production_base_item_id == 0) {
                this.form.production_base_item_id = '';
            }
            if (data.harvest_plan) {
                this.harvestPlan.value = data.harvest_plan
            }
            if (data.report) {
                this.detectionReport.value = data.report
            }
            if (data.package) {
                this.productPackage.value = data.package
            }
            if (data.process) {
                this.processingType.value = data.process
            }
            if (data.product) {
                this.product.value = data.product
            }
        }
    }
}
</script>

<style></style>
