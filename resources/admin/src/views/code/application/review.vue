<template>
    <el-dialog title="审核" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="溯源码数量" prop="grant_quantity">
                <el-input-number v-model="form.grant_quantity" :min="1" :max="99999"></el-input-number>
            </el-form-item>
            <el-form-item label="开始编码" prop="start_number">
                <el-input v-model="form.start_number" clearable></el-input>
            </el-form-item>
        </el-form>
        <template #footer>
            <el-button :loading="isSubmiting" @click="submit('refuse')">退 回</el-button>
            <el-button type="primary" :loading="isSubmiting" @click="submit('pass')">审核通过</el-button>
        </template>
    </el-dialog>
</template>

<script>
export default {
    emits: ['success', 'closed'],
    data () {
        return {
            visible: false,
            isSubmiting: false,
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
            console.log(data)
            this.form = data
            this.form.grant_quantity = data.quantity;
            return this
        },
        //表单提交方法
        submit (action) {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSubmiting = true;
                    const data = {
                        action,
                        data: this.form
                    };
                    await this.$API.app.traceabilityCode.applyfor.handle.post(this.form.id, data)
                        .then(res => {
                            this.isSubmiting = false;
                            if (res.code == 200) {
                                this.$emit('success')
                                this.visible = false;
                                this.$message.success("操作成功")
                            } else {
                                this.$alert(res.message, "提示", { type: 'error' })
                            }
                        })
                        .catch(() => {
                            this.isSubmiting = false;
                        });

                }
            })
        },
    }
}
</script>

<style></style>
