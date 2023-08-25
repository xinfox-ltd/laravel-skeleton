<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">

            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="申请时间" prop="created_at" width="200"></el-table-column>
                <el-table-column label="申请数量" prop="quantity" width="100"></el-table-column>
                <el-table-column label="下发数量" prop="icd" width="100"></el-table-column>
                <el-table-column label="备注" prop="remark" width="220"></el-table-column>
                <el-table-column label="状态" prop="status_label" width="150"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="120">
                    <template #default="scope">
                        <el-button-group>
                            <el-popconfirm title="确定删除吗？" @confirm="del(scope.row)" v-if="scope.row.status == 1">
                                <template #reference>
                                    <el-button text type="primary" :loading="scope.row.$loading" size="small">删除</el-button>
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
                apiObj: this.$API.app.traceabilityCode.applyfor.list,
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


        //删除
        del (row) {
            row.$loading = true
            this.$API.app.traceabilityCode.applyfor.destroy.delete(row.id)
                .then(res => {
                    row.$loading = false
                    if (res.code == 200) {
                        this.$refs.table.refresh()
                        this.$message.success("删除成功")
                    } else {
                        this.$alert(res.message, "提示", { type: 'error' })
                    }
                })
                .catch(() => {
                    row.$loading = false
                });

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
