<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" width="70%" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="流程名" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="工艺步骤" prop="steps">
                <sc-form-table ref="table" v-model="form.steps" :addTemplate="addTemplate" drag-sort placeholder="暂无数据">
                    <el-table-column prop="name" label="工序名" width="180" align="center">
                        <template #default="scope">
                            <el-input v-model="scope.row.name" clearable></el-input>
                        </template>
                    </el-table-column>
                    <el-table-column prop="start" label="开始天数" width="180" align="center">
                        <template #default="scope">
                            <el-input-number v-model="scope.row.start" :min="1" :max="999" :precision="0"></el-input-number>
                        </template>
                    </el-table-column>
                    <el-table-column prop="end" label="结束天数" width="180" align="center">
                        <template #default="scope">
                            <el-input-number v-model="scope.row.end" :min="1" :max="999" :precision="0"></el-input-number>
                        </template>
                    </el-table-column>
                    <el-table-column prop="head" label="负责人" width="200" align="center">
                        <template #default="scope">
                            <sc-table-select v-model="scope.row.head" :apiObj="staff.apiObj" :params="staff.params"
                                :table-width="500" clearable collapse-tags collapse-tags-tooltip :props="staff.props">
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
                        </template>
                    </el-table-column>
                    <el-table-column prop="ramark" label="描述/说明" min-width="250" align="center">
                        <template #default="scope">
                            <el-input type="textarea" :row="3" v-model="scope.row.remark" clearable></el-input>
                        </template>
                    </el-table-column>
                </sc-form-table>
            </el-form-item>
            <el-form-item label="描述" prop="remark">
                <el-input type="textarea" :row="3" v-model="form.remark" clearable></el-input>
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
                add: '新增加工流程',
                edit: '编辑加工流程',
            },
            visible: false,
            isSaveing: false,
            addTemplate: {
                name: "",
                start: 1,
                end: 1,
                head: "",
                remark: "",
            },
            //表单数据
            form: {
                name: "",
                remark: "",
                steps: [],
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入流程名', trigger: 'change' }
                ],
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
                    await this.$API.app.processFlow.save.post(this.form)
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
            if (!data.steps) {
                this.form.steps = []
            }
        }
    }
}
</script>

<style></style>
