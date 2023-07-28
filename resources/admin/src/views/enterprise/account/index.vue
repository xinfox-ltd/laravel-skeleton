<template>
    <el-header>
        <div class="left-panel">
            <el-button type="primary" icon="el-icon-plus" @click="add">新增账号</el-button>
        </div>
        <div class="right-panel">

        </div>
    </el-header>
    <el-main style="padding:0 20px;">
        <scTable ref="table" :apiObj="list.apiObj" :params="list.params" row-key="id" stripe>
            <el-table-column label="#" prop="id" width="80"></el-table-column>
            <el-table-column label="姓名" prop="name" width="150"></el-table-column>
            <el-table-column label="账号" prop="username" width="200"></el-table-column>
            <el-table-column label="手机" prop="phone" width="150"></el-table-column>
            <el-table-column label="添加时间" prop="created_at" width="150"></el-table-column>
            <el-table-column label="操作" fixed="right" align="right" width="170">
                <template #default="scope">
                    <el-button-group>
                        <el-button text type="primary" size="small" @click="edit(scope.row)">编辑</el-button>
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
    <authorize-dialog v-if="dialog.authorize" ref="authorizeDialog" @success="refresh"
        @closed="dialog.authorize = false"></authorize-dialog>
</template>
<script>
import authorizeDialog from './save'
export default {
    emits: ['closed'],
    props: ["enterpriseId"],
    components: {
        authorizeDialog
    },
    data () {
        return {
            dialog: {
                authorize: false
            },
            list: {
                apiObj: this.$API.app.user.list,
                params: {
                    enterprise_id: this.enterpriseId
                }
            },
        }
    },
    methods: {
        add () {
            this.dialog.authorize = true
            this.$nextTick(() => {
                this.$refs.authorizeDialog.open().setData({ enterprise_id: this.enterpriseId })
            })
        },
        edit (row) {
            this.dialog.authorize = true
            this.$nextTick(() => {
                this.$refs.authorizeDialog.open('edit').setData(row)
            })
        },
        refresh () {
            this.$refs.table.refresh()
        }
    },
}
</script>