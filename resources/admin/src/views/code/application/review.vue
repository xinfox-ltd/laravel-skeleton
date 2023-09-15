<template>
    <el-dialog title="审核" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="溯源码数量" prop="quantity">
                <el-input-number v-model="form.quantity" :min="1" :max="99999"></el-input-number>
            </el-form-item>
            <el-form-item label="开始编码" prop="remark">
                <el-input v-model="form.remark" clearable></el-input>
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
            visible: false,
            isSaveing: false,
            //表单数据
            form: {
                quantity: 100,
            },
            //验证规则
            rules: {
                quantity: [
                    { required: true, message: '请填写申请数量', trigger: 'change' }
                ],
            }
        }
    },
    mounted () {

    },
    methods: {
        //显示
        open (data) {
            this.visible = true;
            this.form = data
            return this
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.traceabilityCode.applyfor.save.post(this.form)
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
