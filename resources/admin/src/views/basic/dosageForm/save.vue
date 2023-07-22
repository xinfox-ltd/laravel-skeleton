<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="投入品类别" prop="input_category_id">
                <el-select v-model="form.input_category_id" clearable placeholder="选择类别">
                    <el-option v-for="item in inputCategoryOptions" :key="item.id" :label="item.name" :value="item.id" />
                </el-select>
            </el-form-item>
            <el-form-item label="剂型名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="备注" prop="remark">
                <el-input type="textarea" :rows="3" v-model="form.remark" clearable></el-input>
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
                add: '新增剂型',
                edit: '编辑剂型',
            },
            visible: false,
            isSaveing: false,
            inputCategoryOptions: [],
            //表单数据
            form: {
                name: "",
                input_category_id: "",
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入剂型名称', trigger: 'change' }
                ],
                input_category_id: [
                    { required: true, message: '请选择投入品类别', trigger: 'change' }
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
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.dosageForm.save.post(this.form)
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
        }
    }
}
</script>

<style></style>
