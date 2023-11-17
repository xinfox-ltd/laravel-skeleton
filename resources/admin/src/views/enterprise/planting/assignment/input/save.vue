<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="550" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="110px" label-position="right">
            <el-form-item label="投入品" prop="input_id">
                <sc-table-select v-model="inputList.value" :apiObj="inputList.apiObj" :params="inputList.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="inputList.props"
                    @change="onInputListChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="投入品名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="投入品名称" prop="name" width="200"></el-table-column>
                    <el-table-column label="类型" prop="category_name" width="100"></el-table-column>
                    <el-table-column label="供应商" prop="supplier_name" width="120"></el-table-column>
                    <el-table-column label="生产企业" prop="enterprise" width="120"></el-table-column>
                    <el-table-column label="登记证号" prop="registration_no" width="120"></el-table-column>
                    <el-table-column label="剂型" prop="dosage_form_name" width="120"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="计量单位类型" prop="unit_type">
                <el-radio-group v-model="form.unit_type" @change="onUnitTypeChange">
                    <el-radio :label="1">每亩</el-radio>
                    <el-radio :label="2">每平方</el-radio>
                    <el-radio :label="3">每立方米</el-radio>
                    <el-radio :label="4">稀释倍数</el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="使用量" prop="quantity">
                <el-input v-model="form.quantity" clearable>
                    <template #append>
                        <el-select v-model="form.unit_id" placeholder="计量单位" style="width: 105px">
                            <el-option :label="item.label" :value="item.value" v-for="(item, index) in measurementUnits"
                                :key="index" />
                        </el-select>
                    </template>
                </el-input>
            </el-form-item>
            <el-form-item label="使(施)用方法" prop="method">
                <el-input v-model="form.method" clearable></el-input>
            </el-form-item>
            <el-form-item label="作业周期" prop="input_date">
                <el-date-picker v-model="form.input_date" type="daterange" range-separator="到" start-placeholder="开始时间"
                    end-placeholder="结束时间" value-format="YYYY-MM-DD" placeholder="选择一个日期" />
            </el-form-item>
            <el-form-item label="备注" prop="remark">
                <el-input type="textarea" :row="2" v-model="form.remark" clearable></el-input>
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
    props: {
        assignmentId: Number
    },
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
            inputList: {
                value: {},
                apiObj: this.$API.app.input.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            measurementUnits: [
                { label: "克", value: 1 },
                { label: "毫升", value: 2 },
                { label: "公斤", value: 3 },
                { label: "吨", value: 4 },
            ],
            //表单数据
            form: {
                assignment_content: "",
                input_id: "",
                method: "",
                input_date: "",
                unit_type: 1
            },
            //验证规则
            rules: {
                input_id: [
                    { required: true, message: '请选择投入品' }
                ],
                unit_type: [
                    { required: true, message: '请选择使用计量单位类型' }
                ],
                quantity: [
                    { required: true, message: '请填写使用量' }
                ],
                method: [
                    { required: true, message: '请填写使(施)用方法' }
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
        onInputListChange (val) {
            console.log(val);
            this.form.input_id = val.id
        },
        onUnitTypeChange (val) {
            this.form.unit_id = '';
            if (val == 4) {
                this.measurementUnits = [
                    { label: "倍", value: 4 },
                ];
            } else {

                this.measurementUnits = [
                    { label: "克", value: 1 },
                    { label: "毫升", value: 2 },
                    { label: "公斤", value: 3 },
                    { label: "吨", value: 4 },
                ];
            }
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.plantingAssignment.input.save.post(this.assignmentId, this.form)
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
            this.inputList.value = {
                id: data.input_id,
                name: data.input_name,
            }
            if (data.unit_id == 0) {
                this.form.unit_id = '';
            }
        }
    }
}
</script>

<style></style>
