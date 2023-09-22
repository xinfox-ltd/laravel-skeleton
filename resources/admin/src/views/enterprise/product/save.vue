<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="600" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="产品" prop="product_id">
                <sc-table-select v-model="product.value" :apiObj="product.apiObj" :params="product.params"
                    :table-width="700" clearable collapse-tags collapse-tags-tooltip :props="product.props"
                    @change="onProductChange">
                    <template #header="{ form, submit }">
                        <el-form :inline="true" :model="form">
                            <el-form-item>
                                <el-input v-model="form.keyword" placeholder="产品名称" clearable></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="submit">查询</el-button>
                            </el-form-item>
                        </el-form>
                    </template>
                    <el-table-column label="产品名称" prop="name" width="250"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="品牌" prop="trademark_id">
                <el-select v-model="form.trademark_id" placeholder="选择商标/品牌" v-loading="trademarkLoading"
                    style="width: 100%;">
                    <el-option v-for="item in trademarks" :key="item.id"
                        :label="item.name + '(' + item.registration_no + ')'" :value="item.id" />
                </el-select>
            </el-form-item>
            <el-form-item label="质保期" prop="warranty_period">
                <el-input v-model="form.warranty_period"></el-input>
            </el-form-item>
            <el-form-item label="产品图片" prop="images">
                <sc-upload-multiple v-model="form.images" draggable :limit="5"
                    tip="最多上传3个文件,单个文件不要超过10M,请上传图像格式文件"></sc-upload-multiple>
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
                add: '新增产品',
                edit: '编辑产品',
                show: '查看'
            },
            visible: false,
            isSaveing: false,
            trademarkLoading: false,
            trademarks: [],
            product: {
                value: {},
                apiObj: this.$API.app.product.list,
                params: {},
                props: {
                    label: 'name',
                    value: 'id',
                    keyword: "keyword"
                }
            },

            //表单数据
            form: {
                product_id: "",
            },
            //验证规则
            rules: {
                product_id: [
                    { required: true, message: '请选择产品', trigger: 'change' }
                ],
                trademark_id: [
                    { required: true, message: '请选择品牌', trigger: 'change' }
                ],
                warranty_period: [
                    { required: true, message: '请填写质保期', trigger: 'change' }
                ]
            }
        }
    },
    mounted () {
        this.getTrademarkList();
    },
    methods: {
        getTrademarkList () {
            this.trademarkLoading = true
            this.$API.app.trademark.list.get({ simple: true })
                .then(res => {
                    this.trademarkLoading = false
                    this.trademarks = res.data
                })
                .catch(() => {
                    this.trademarkLoading = false
                })
        },
        //显示
        open (mode = 'add') {
            this.mode = mode;
            this.visible = true;
            return this
        },
        onProductChange (val) {
            console.log(val);
            this.form.product_id = val.id
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.enterprise.product.save.post(this.form)
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
            if (data.trademark_id == 0) {
                this.form.trademark_id = ''
            }
            this.product.value = {
                id: data.product_id,
                name: data.product_name
            }
        }
    }
}
</script>

<style></style>
