<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="120px" label-position="right">
            <el-form-item label="计划名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="种植计划" prop="planting_plan_id">
                <sc-table-select v-model="plantingPlan.value" :apiObj="plantingPlan.apiObj" :params="plantingPlan.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="plantingPlan.props"
                    @change="onPlantingPlanChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="计划名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="计划名称" prop="name" width="200"></el-table-column>
                    <el-table-column label="基地" prop="production_base_name" width="200"></el-table-column>
                    <el-table-column label="产出产品" prop="product_name" width="120"></el-table-column>
                    <el-table-column label="负责人" prop="staff_name" width="100"></el-table-column>
                    <el-table-column prop="created_at" width="150" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="原料及等级" prop="raw_material_id">
                <sc-table-select v-model="rawMaterial.value" :apiObj="rawMaterial.apiObj" :params="rawMaterial.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="rawMaterial.props"
                    @change="onRawMaterialChange">
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
                    <el-table-column label="原料名称" prop="name" width="200"></el-table-column>
                    <el-table-column label="级别名称" prop="level" width="200"></el-table-column>
                    <el-table-column prop="created_at" width="150" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="负责人" prop="staff_id">
                <sc-table-select v-model="staff.value" :apiObj="staff.apiObj" :params="staff.params" :table-width="700"
                    clearable collapse-tags collapse-tags-tooltip :props="staff.props" @change="onStaffChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="姓名" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="姓名" prop="name" width="100"></el-table-column>
                    <el-table-column label="电话" prop="phone" width="120"></el-table-column>
                    <el-table-column prop="created_at" width="150" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="计划周期" prop="plan_date">
                <el-date-picker v-model="form.plan_date" type="daterange" range-separator="到" start-placeholder="开始日期"
                    end-placeholder="结束日期" value-format="YYYY-MM-DD" />
            </el-form-item>
            <el-form-item label="备注" prop="remark">
                <el-input v-model="form.remark" type="textarea" :row="3" placeholder="备注" />
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
                add: '新增采收计划',
                edit: '编辑采收计划',
            },
            visible: false,
            isSaveing: false,
            plantingPlan: {
                value: {},
                apiObj: this.$API.app.planting.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            rawMaterial: {
                value: {},
                apiObj: this.$API.app.rawMaterial.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            staff: {
                value: {},
                apiObj: this.$API.app.enterprise.staff.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            //表单数据
            form: {
                name: "",
                planting_plan_id: "",
                staff_id: "",
                raw_material_id: "",
                plan_date: ""
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入计划名称', trigger: 'change' }
                ],
                planting_plan_id: [
                    { required: true, message: '请选择种植计划' }
                ],
                raw_material_id: [
                    { required: true, message: '请选择原料/等级' }
                ],
                staff_id: [
                    { required: true, message: '请选择负责人' }
                ],
                plan_date: [
                    { required: true, message: '请填写计划周期' }
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
        onPlantingPlanChange (val) {
            console.log(val);
            this.form.planting_plan_id = val.id
        },
        onStaffChange (val) {
            console.log(val);
            this.form.user_id = val.id
        },
        onRawMaterialChange (val) {
            this.form.raw_material_id = val.id
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.harvestPlan.save.post(this.form)
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
            this.plantingPlan.value = {
                id: data.planting_plan_id,
                name: data.planting_plan_name,
            }
            this.staff.value = {
                id: data.staff_id,
                name: data.staff_name,
            }
            this.rawMaterial.value = {
                id: data.raw_material_id,
                name: data.raw_material_name,
            }
        }
    }
}
</script>

<style></style>
