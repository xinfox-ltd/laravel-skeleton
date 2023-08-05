<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="120px" label-position="right">
            <el-form-item label="包装名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="输出产品" prop="enterprise_product_id">
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
                    <el-table-column label="产品名称" prop="product_name" width="250"></el-table-column>
                    <el-table-column label="品牌/商标" prop="trademark_name" width="100"></el-table-column>
                    <el-table-column prop="created_at" label="添加时间"></el-table-column>
                </sc-table-select>
            </el-form-item>
            <el-form-item label="规格" prop="spec">
                <el-input v-model="form.spec" clearable></el-input>
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
                add: '新增加工类型',
                edit: '编辑加工类型',
            },
            visible: false,
            isSaveing: false,
            product: {
                value: {},
                apiObj: this.$API.app.enterprise.product.list,
                params: {},
                props: {
                    label: 'product_name',
                    value: 'id',
                    keyword: "keyword"
                }
            },
            //表单数据
            form: {
                name: "",
                enterprise_product_id: "",
                spec: "",
                images: "",
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入加工类型名称', trigger: 'change' }
                ],
                enterprise_product_id: [
                    { required: true, message: '请选择产品' }
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
        onProductChange (val) {
            this.form.enterprise_product_id = val.id
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.package.save.post(this.form)
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
            if (data.enterprise_product_id > 0) {
                this.product.value = {
                    id: data.enterprise_product_id,
                    product_name: data.enterprise_product_name,
                }
            }
        }
    }
}
</script>

<style></style>
