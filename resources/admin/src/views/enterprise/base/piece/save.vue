<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="地块名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="基地单元" prop="base_unit_id">
                <sc-table-select v-model="staff.value" :apiObj="staff.apiObj" :params="staff.params" :table-width="700"
                    clearable collapse-tags collapse-tags-tooltip :props="staff.props" @change="onBaseUnit">
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
                    <el-table-column label="姓名" prop="name" width="150"></el-table-column>
                    <el-table-column label="电话" prop="phone" width="120"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="地区" prop="regional_location">
                <el-input v-model="form.regional_location" clearable></el-input>
            </el-form-item>
            <el-form-item label="面积" prop="area">
                <el-input v-model="form.area" clearable>
                    <template #append>
                        <el-select v-model="form.area_unit" placeholder="请选择" style="width: 95px">
                            <el-option label="亩" :value="1" />
                            <el-option label="平方米" :value="2" />
                        </el-select>
                    </template>
                </el-input>
            </el-form-item>
            <el-row>
                <el-col :span="12">
                    <el-form-item label="经度" prop="lng">
                        <el-input v-model="form.lng" clearable></el-input>
                    </el-form-item></el-col>
                <el-col :span="12">
                    <el-form-item label="维度" prop="lat">
                        <el-input v-model="form.lat" clearable></el-input>
                    </el-form-item></el-col>
            </el-row>
            <el-form-item label="负责人" prop="enterprise_staff_id">
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
                    <el-table-column label="姓名" prop="name" width="150"></el-table-column>
                    <el-table-column label="电话" prop="phone" width="120"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="描述" prop="remark">
                <el-input type="textarea" :rows="3" v-model="form.remark" maxlength="60" placeholder="请输入描述" show-word-limit
                    clearable></el-input>
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
            baseId: 0,
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
                id: 0,
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请填写地块名称' }
                ],
                area: [
                    { required: true, message: '请填写面积' }
                ],
                area_unit: [
                    { required: true, message: '请选择面积单位' }
                ],
                enterprise_staff_id: [
                    { required: true, message: '请选择负责人' }
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
        setBaseId (baseId) {
            this.baseId = baseId
            return this
        },
        onBaseUnit (val) {
            console.log(val);
            this.form.input_id = val.id
        },
        onStaffChange (data) {
            console.log(data)
            this.form.enterprise_staff_id = data.id
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    if (!this.form.area_unit) {
                        this.$alert('请选择地块面积单位', "提示", { type: 'error' })
                        return;
                    }
                    this.isSaveing = true;
                    await this.$API.app.productionBase.piece.save.post(this.baseId, this.form)
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
            this.staff.value = {
                id: data.manager.id,
                name: data.manager.name,
            }
        }
    }
}
</script>

<style></style>
