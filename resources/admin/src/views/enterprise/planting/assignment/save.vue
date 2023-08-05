<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="120px" label-position="right">

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
                    <el-table-column label="负责人" prop="staff_name" width="120"></el-table-column>
                    <el-table-column label="计划结束时间" prop="end_date" width="120"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间" width="150"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="作业内容" prop="assignment_content">
                <el-input v-model="form.assignment_content" clearable></el-input>
            </el-form-item>
            <el-form-item label="作业周期" prop="date">
                <el-date-picker v-model="form.date" type="daterange" range-separator="到" start-placeholder="开始时间"
                    end-placeholder="结束时间" value-format="YYYY-MM-DD" placeholder="选择一个日期" />
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
                add: '新增农事作业',
                edit: '编辑农事作业',
                show: '查看'
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

            //表单数据
            form: {
                assignment_content: "",
                planting_plan_id: "",
                date: "",
            },
            //验证规则
            rules: {
                assignment_content: [
                    { required: true, message: '请输入作业内容', trigger: 'change' }
                ],
                planting_plan_id: [
                    { required: true, message: '请选择种植计划' }
                ],
                date: [
                    { required: true, message: '请选择作业周期时间' }
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
        onPlantingPlanChange (val) {
            console.log(val);
            this.form.planting_plan_id = val.id
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.plantingAssignment.save.post(this.form)
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
        }
    }
}
</script>

<style></style>
