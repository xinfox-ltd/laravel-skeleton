<template>
    <el-container>
        <el-header class="header-tabs">
            <el-tabs type="card" v-model="list.params.type" @tab-change="tabChange">
                <el-tab-pane label="网店" :name="1"></el-tab-pane>
                <el-tab-pane label="实体店" :name="2"></el-tab-pane>
                <el-tab-pane label="联系方式" :name="3"></el-tab-pane>
            </el-tabs>
        </el-header>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" :params="list.params" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="网店名称" prop="name" width="200" v-if="list.params.type == 1"></el-table-column>
                <el-table-column label="电话" prop="data.phone" width="120" v-if="list.params.type == 1"></el-table-column>
                <el-table-column label="备注" prop="data.remark" width="220" v-if="list.params.type == 1"></el-table-column>

                <el-table-column label="实体店名称" prop="name" width="200" v-if="list.params.type == 2"></el-table-column>
                <el-table-column label="经度" prop="data.lng" width="200" v-if="list.params.type == 2"></el-table-column>
                <el-table-column label="纬度" prop="data.lat" width="200" v-if="list.params.type == 2"></el-table-column>

                <el-table-column label="联系人" prop="name" width="200" v-if="list.params.type == 3"></el-table-column>
                <el-table-column label="电话" prop="data.phone" width="100" v-if="list.params.type == 3"></el-table-column>
                <el-table-column label="备注" prop="data.remark" width="220" v-if="list.params.type == 3"></el-table-column>

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
                apiObj: this.$API.app.enterprise.channel.list,
                params: {
                    type: 1,
                }
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
                this.$refs.saveDialog.open().setData({ type: this.list.params.type })
            })
        },
        //编辑
        edit (row) {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open('edit').setData(row)
            })
        },

        //删除
        del (row) {
            this.$API.app.enterprise.channel.destroy.delete(row.id)
                .then(() => {
                    this.$refs.table.refresh()
                    this.$message.success("删除成功")
                });
        },

        tabChange () {
            this.$refs.table.refresh()
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
