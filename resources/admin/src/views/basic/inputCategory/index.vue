<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="类别名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="类别名称" prop="name" width="200"></el-table-column>
                <el-table-column label="备注" prop="remark" width="200"></el-table-column>
                <el-table-column label="添加时间" prop="created_at" width="200"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="170">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small" @click="edit(scope.row)">编辑</el-button>
                            <el-popconfirm title="确定删除吗？" @confirm="del(scope.row)">
                                <template #reference>
                                    <el-button text type="primary" size="small" :loading="scope.row.$loading">删除</el-button>
                                </template>
                            </el-popconfirm>
                        </el-button-group>
                    </template>
                </el-table-column>

            </scTable>
        </el-main>
    </el-container>

    <save-dialog v-if="dialog.save" ref="saveDialog" @success="onSaveSuccess" @closed="dialog.save = false"></save-dialog>
</template>

<script>
import saveDialog from './save'

export default {
    name: 'role',
    components: {
        saveDialog,
    },
    data () {
        return {
            dialog: {
                save: false,
                // permission: false
            },
            list: {
                apiObj: this.$API.app.inputCategory.list,
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
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open('edit').setData(row)
            })
        },

        del (row) {
            row.$loading = true;
            this.$API.app.inputCategory.clear.delete(row.id)
                .then(res => {
                    row.$loading = false;
                    if (res.code == 200) {
                        this.$message.success('操作成功');
                        this.refresh();
                    } else {
                        this.$alert(res.message, "提示", { type: 'error' })
                    }
                })
                .catch(() => {
                    row.$loading = false;
                })
        },

        //搜索
        upsearch () {
            this.$refs.table.upData(this.search);
        },

        onSaveSuccess () {
            this.refresh();
        },
        //本地更新数据
        refresh () {
            this.$refs.table.refresh()
        }
    }
}
</script>

<style></style>
