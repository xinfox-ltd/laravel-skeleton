<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="投入品名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="投入品名称" prop="name" width="200"></el-table-column>
                <el-table-column label="类型" prop="category_name" width="100"></el-table-column>
                <el-table-column label="供应商" prop="supplier_name" width="120"></el-table-column>
                <el-table-column label="生产企业" prop="enterprise" width="120"></el-table-column>
                <el-table-column label="登记证号" prop="registration_no" width="120"></el-table-column>
                <el-table-column label="剂型" prop="dosage_form_name" width="120"></el-table-column>
                <el-table-column label="添加时间" prop="created_at" width="180"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="170">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small" :loading="scope.row.$loading"
                                @click="edit(scope.row)">编辑</el-button>
                            <el-popconfirm title="确定删除吗？" @confirm="del(scope.row)">
                                <template #reference>
                                    <el-button text type="primary" size="small">删除</el-button>
                                </template>
                            </el-popconfirm>
                        </el-button-group>
                    </template>
                </el-table-column>

            </scTable>
        </el-main>
    </el-container>

    <save-dialog v-if="dialog.save" ref="saveDialog" @success="refresh" @closed="dialog.save = false"></save-dialog>
</template>

<script>
import saveDialog from './save'
// import permissionDialog from './permission'

export default {
    name: 'role',
    components: {
        saveDialog,
        // permissionDialog
    },
    data () {
        return {
            dialog: {
                save: false,
                permission: false
            },
            list: {
                apiObj: this.$API.app.planting.list,
            },
            search: {
                keyword: null
            }
        }
    },
    methods: {
        //添加
        add () {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open()
            })
        },
        //编辑
        edit (row) {
            row.$loading = true
            this.$API.app.input.info.get(row.id)
                .then(res => {
                    row.$loading = false
                    this.dialog.save = true
                    this.$nextTick(() => {
                        this.$refs.saveDialog.open('edit').setData(res.data)
                    })
                })

        },

        //删除
        async table_del (row) {
            var reqData = { id: row.id }
            var res = await this.$API.demo.post.post(reqData);
            if (res.code == 200) {
                this.$refs.table.refresh()
                this.$message.success("删除成功")
            } else {
                this.$alert(res.message, "提示", { type: 'error' })
            }
        },

        //搜索
        upsearch () {
            this.$refs.table.upData(this.search);
        },

        //本地更新数据
        refresh () {
            this.$refs.table.refresh()
        }
    }
}
</script>

<style></style>
