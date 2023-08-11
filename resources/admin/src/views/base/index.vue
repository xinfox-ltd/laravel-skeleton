<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="单元名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="基地单元名称" prop="label" width="150"></el-table-column>
                <el-table-column label="乡镇" prop="alias" width="200"></el-table-column>
                <el-table-column label="基地单元编号" prop="sort" width="150"></el-table-column>
                <el-table-column label="基地单元规模（亩）" prop="sort" width="150"></el-table-column>
                <el-table-column label="自然村数（个）" prop="sort" width="150"></el-table-column>
                <el-table-column label="农户数（户）" prop="sort" width="150"></el-table-column>
                <el-table-column label="基地单元负责人" prop="date" width="150"></el-table-column>
                <el-table-column label="联系电话" prop="date" width="150"></el-table-column>
                <el-table-column label="添加时间" prop="created_at" min-width="150"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="170">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small"
                                @click="table_show(scope.row, scope.$index)">查看</el-button>
                            <el-button text type="primary" size="small"
                                @click="table_edit(scope.row, scope.$index)">编辑</el-button>
                            <el-popconfirm title="确定删除吗？" @confirm="table_del(scope.row, scope.$index)">
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

    <save-dialog v-if="dialog.save" ref="saveDialog" @success="handleSaveSuccess" @closed="dialog.save = false"></save-dialog>

    <!-- <permission-dialog v-if="dialog.permission" ref="permissionDialog" @closed="dialog.permission=false"></permission-dialog> -->
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
                apiObj: this.$API.app.baseUnit.list,
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
        table_edit (row) {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open('edit').setData(row)
            })
        },
        //查看
        table_show (row) {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open('show').setData(row)
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

        },

        //本地更新数据
        refresh () {
            this.$refs.table.refresh()
        }
    }
}
</script>

<style></style>
