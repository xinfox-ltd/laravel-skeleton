<template>
    <el-dialog :title="titleMap[mode]" v-model="visible" :width="600" destroy-on-close @closed="$emit('closed')">
        <el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px" label-position="right">
            <el-form-item label="商标名称" prop="name">
                <el-input v-model="form.name" clearable></el-input>
            </el-form-item>
            <el-form-item label="注册号" prop="registration_no">
                <el-input v-model="form.registration_no" clearable></el-input>
            </el-form-item>
            <el-form-item label="国际分类" prop="icd">
                <el-input v-model="form.icd" clearable></el-input>
            </el-form-item>
            <el-form-item label="颁证机构" prop="awarding_bodies">
                <el-input v-model="form.awarding_bodies" clearable></el-input>
            </el-form-item>
            <el-form-item label="有效期" prop="valid_date">
                <el-date-picker v-model="form.valid_date" type="daterange" range-separator="到" start-placeholder="开始日期"
                    end-placeholder="结束日期" value-format="YYYY-MM-DD" />
            </el-form-item>
            <el-form-item label="扫描件" prop="scan_file">
                <sc-upload-multiple v-model="form.scan_file" draggable :limit="5"
                    tip="最多上传5个文件,单个文件不要超过10M,请上传图像格式文件"></sc-upload-multiple>
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
                add: '新增商标',
                edit: '编辑商标',
            },
            visible: false,
            isSaveing: false,
            //表单数据
            form: {
                name: "",
            },
            //验证规则
            rules: {
                name: [
                    { required: true, message: '请输入证书名称', trigger: 'change' }
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
            console.log(val);
            this.form.product_id = val.id
        },
        //表单提交方法
        submit () {
            this.$refs.dialogForm.validate(async (valid) => {
                if (valid) {
                    this.isSaveing = true;
                    await this.$API.app.trademark.save.post(this.form)
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
