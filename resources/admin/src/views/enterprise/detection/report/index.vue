<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="检测报告名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="检测报告" prop="name" width="200"></el-table-column>
                <el-table-column label="产品" prop="product_name" width="150"></el-table-column>
                <el-table-column label="检测类型" prop="detection_type" width="150"></el-table-column>
                <el-table-column label="检测机构" prop="detection_institution" width="250"></el-table-column>
                <el-table-column label="检测结果" prop="is_qualified" width="100">
                    <template #default="scope">
                        <el-tag type="success" v-if="scope.row.is_qualified == 1">合格</el-tag>
                        <el-tag type="info" v-else>不合格</el-tag>
                    </template>
                </el-table-column>
                <el-table-column label="报告日期" prop="report_date" width="120"></el-table-column>
                <el-table-column label="添加时间" prop="created_at" width="150"></el-table-column>
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
                apiObj: this.$API.app.detectionReport.list,
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
            this.$API.app.detectionReport.info.get(row.id)
                .then(res => {
                    row.$loading = false
                    this.dialog.save = true
                    this.$nextTick(() => {
                        this.$refs.saveDialog.open('edit').setData(res.data)
                    })
                })

        },

        //删除
        del (row) {
            row.$loading = true;
            this.$API.app.detectionReport.destroy.delete(row.id)
                .then(res => {
                    row.$loading = false;
                    if (res.code == 200) {
                        this.refresh()
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
