<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="600" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="基地名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="类型" prop="type">
                <el-select v-model="form.type" placeholder="请选择基地类型">
                    <el-option v-for="item in typeOptions" :key="item.value" :label="item.label" :value="item.value"
                        :disabled="item.disabled" />
                </el-select>
            </el-form-item>
            <el-form-item label="地区" prop="region">
                <el-input v-model="form.region" clearable></el-input>
            </el-form-item>
            <el-form-item label="规模" prop="area">
                <el-input v-model="form.area" clearable>
                    <template #append>
                        亩
                    </template>
                </el-input>
            </el-form-item>
            <el-row>
                <el-col :span="12">
                    <el-form-item label="自然村数" prop="lng">
                        <el-input v-model="form.lng" clearable>
                            <template #append>
                                个
                            </template>
                        </el-input>
                    </el-form-item></el-col>
                <el-col :span="12">
                    <el-form-item label="农户数" prop="lat">
                        <el-input v-model="form.lat" clearable>
                            <template #append>
                                户
                            </template>
                        </el-input>
                    </el-form-item></el-col>
            </el-row>
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
                add: '新增基地',
                edit: '编辑基地',
                show: '查看'
            },
            visible: false,
            isSaveing: false,
            typeOptions: [
                {
                    value: 1,
                    label: '生产基地',
                },
                {
                    value: 2,
                    label: '加工基地',
                    // disabled: true,
                },
            ],
            //表单数据
            form: {
                name: "",
                type: "",
                region: "",
                area: "",
                address: "",
                images: ""
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入基地名称', trigger: 'change' }
                ],
                type: [
                    { required: true, message: '请选择企业类型' }
                ],
                region: [
                    { required: true, message: '请输入所在地区' }
                ],
                area: [
                    { required: true, message: '请输入基地面积' }
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
                    await this.$API.app.productionBase.save.post(this.form)
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
