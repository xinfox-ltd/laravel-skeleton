<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="600" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="渠道类型" prop="type">
                <el-select v-model="form.type" placeholder="请选择基地类型">
                    <el-option v-for="item in typeOptions" :key="item.value" :label="item.label" :value="item.value"
                        :disabled="item.disabled" />
                </el-select>
            </el-form-item>
            <el-form-item label="网店名称" prop="name" v-if="form.type == 1">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="电话" prop="phone" v-if="form.type == 1">
                <el-input v-model="form.data.phone" clearable></el-input>
            </el-form-item>
            <el-form-item label="备注" prop="remark" v-if="form.type == 1">
                <el-input type="textarea" :rows="3" v-model="form.data.remark" maxlength="60" placeholder="请输入备注"
                    show-word-limit clearable></el-input>
            </el-form-item>

            <el-form-item label="实体店名称" prop="name" v-if="form.type == 2">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-row v-if="form.type == 2">
                <el-col :span="12">
                    <el-form-item label="经度" prop="lng">
                        <el-input v-model="form.data.lng" clearable></el-input>
                    </el-form-item></el-col>
                <el-col :span="12">
                    <el-form-item label="维度" prop="lat">
                        <el-input v-model="form.data.lat" clearable></el-input>
                    </el-form-item></el-col>
            </el-row>

            <el-form-item label="联系人" prop="name" v-if="form.type == 3">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="电话" prop="phone" v-if="form.type == 3">
                <el-input v-model="form.data.phone" clearable></el-input>
            </el-form-item>
            <el-form-item label="备注" prop="remark" v-if="form.type == 3">
                <el-input type="textarea" :rows="3" v-model="form.data.remark" maxlength="60" placeholder="请输入备注"
                    show-word-limit clearable></el-input>
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
                show: '查看'
            },
            visible: false,
            isSaveing: false,
            typeOptions: [
                {
                    value: 1,
                    label: '网店',
                },
                {
                    value: 2,
                    label: '实体店',
                    // disabled: true,
                },
                {
                    value: 3,
                    label: '联系方式',
                    // disabled: true,
                },
            ],
            //表单数据
            form: {
                name: "",
                type: 1,
                data: {}
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入名称', trigger: 'change' }
                ],
                type: [
                    { required: true, message: '请选择渠道类型' }
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
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.enterprise.channel.save.post(this.form)
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
