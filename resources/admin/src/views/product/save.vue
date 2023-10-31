<template>
    <el-main style="padding:0 20px;">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="产品名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="产品产地" prop="origin">
                <el-input v-model="form.origin" clearable></el-input>
            </el-form-item>
            <el-form-item label="图片" prop="images">
                <sc-upload-multiple v-model="form.images" draggable :limit="5"
                    tip="最多上传3个文件,单个文件不要超过10M,请上传图像格式文件"></sc-upload-multiple>
            </el-form-item>
            <el-form-item label="备注" prop="address">
                <el-input type="textarea" :rows="3" v-model="form.address" maxlength="60" placeholder="请输入企业地址"
                    show-word-limit clearable></el-input>
            </el-form-item>
            <!-- <el-form-item label="产品介绍" prop="intro">
                <sc-editor v-model="form.intro" placeholder="请输入" :templates="templates" :height="400"></sc-editor>
            </el-form-item> -->
            <el-form-item prop="intro">
                <el-button @click="$emit('closed')">取 消</el-button>
                <el-button type="primary" :loading="isSaveing" @click="submit()">保 存</el-button>
            </el-form-item>
        </el-form>

    </el-main>
</template>

<script>
// import { defineAsyncComponent } from 'vue';
// const scEditor = defineAsyncComponent(() => import('@/components/scEditor'));
export default {
    emits: ['success', 'closed'],
    comments: {
        // scEditor
    },
    data () {
        return {
            visible: false,
            mode: "add",
            titleMap: {
                add: '新增产品',
                edit: '编辑产品',
            },
            isSaveing: false,
            // templates: [
            //     {
            //         title: '自定义HTML模板',
            //         description: '',
            //         content: '<strong>演示模板</strong>'
            //     },
            //     {
            //         title: '列表',
            //         description: '',
            //         content: '<ol><li>演示列表1</li><li>演示列表2</li></ol>'
            //     }
            // ],
            //表单数据
            form: {
                name: "",
                images: "",
                intro: "",
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入产品名称', trigger: 'change' }
                ],
                images: [
                    { required: true, message: '请上传商品图片' }
                ],
                origin: [
                    { required: true, message: '请输入产品产地' }
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
                    await this.$API.app.product.save.post(this.form)
                        .then(res => {
                            this.isSaveing = false;
                            if (res.code == 200) {
                                this.$emit('success')
                                this.visible = false
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
            this.form.images = data.images.join(',')
        }
    }
}
</script>

<style></style>
