<template>
    <el-main>
        <el-card shadow="never">
            <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
                <el-form-item label="企业名称" prop="name">
                    <el-input v-model="form.name" clearable></el-input>
                </el-form-item>
                <el-form-item label="企业类型" prop="type">
                    <el-select v-model="form.type" placeholder="请选择企业类型">
                        <el-option v-for="item in typeOptions" :key="item.value" :label="item.label" :value="item.value"
                            :disabled="item.disabled" />
                    </el-select>
                </el-form-item>
                <el-form-item label="企业法人" prop="legal_person">
                    <el-input v-model="form.legal_person" clearable></el-input>
                </el-form-item>
                <el-form-item label="联系电话" prop="phone">
                    <el-input v-model="form.phone" clearable></el-input>
                </el-form-item>
                <el-form-item label="企业地址" prop="address">
                    <el-input type="textarea" :rows="3" v-model="form.address" maxlength="60" placeholder="请输入企业地址"
                        show-word-limit clearable></el-input>
                </el-form-item>
                <el-form-item label="产品" prop="products">
                    <el-input v-model="form.products" clearable></el-input>
                </el-form-item>
                <el-form-item label="企业介绍" prop="intro">
                    <sc-editor v-model="form.intro" placeholder="请输入" :height="400"></sc-editor>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" :loading="isSaveing" @click="submit()">保 存</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </el-main>
</template>

<script>
import { defineAsyncComponent } from 'vue';
const scEditor = defineAsyncComponent(() => import('@/components/scEditor'));
export default {
    name: "enterpriseInfo",
    components: {
        scEditor
    },
    data () {
        return {
            isSaveing: false,
            typeOptions: [
                {
                    value: 1,
                    label: '国家级龙头企业',
                },
                {
                    value: 2,
                    label: '自治区级龙头企业',
                    // disabled: true,
                },
                {
                    value: 3,
                    label: '市级龙头企业',
                },
                {
                    value: 4,
                    label: '其他企业',
                },
            ],
            //表单数据
            form: {
                name: "",
                type: "",
                legal_person: "",
                phone: "",
                address: "",
                products: null,
                status: false,
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入企业名称', trigger: 'change' }
                ],
                type: [
                    { required: true, message: '请选择企业类型' }
                ],
                legal_person: [
                    { required: true, message: '请输入企业法人' }
                ],
                phone: [
                    { required: true, message: '请输入联系电话' }
                ],
                address: [
                    { required: true, message: '请输入企业地址' }
                ],
                products: [
                    { required: true, message: '请选择产品' }
                ]
            }
        }
    },
    mounted () {
        this.getenterpriseInfo();
    },
    methods: {
        getenterpriseInfo () {
            this.$API.app.enterprise.info.get('me')
                .then(res => {
                    this.form = res.data
                })
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.enterprise.save.post(this.form)
                        .then(res => {
                            this.isSaveing = false;
                            if (res.code == 200) {
                                this.$emit('success', this.form, this.mode)
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
