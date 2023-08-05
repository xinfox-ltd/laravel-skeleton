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
            <scTable ref="table" v-loading="loading" :data="data" row-key="id" hidePagination hideDo stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="投入品名称" prop="input_name" width="200"></el-table-column>
                <el-table-column label="使用量" prop="quantity" width="120"></el-table-column>
                <el-table-column label="使(施)用方法" prop="method" width="150"></el-table-column>
                <el-table-column label="使用时间" prop="input_date" width="220">
                    <template #default="scope">
                        <el-tag>{{ scope.row.input_date[0] }}</el-tag> - <el-tag>{{ scope.row.input_date[1] }}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="140">
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

    <save-dialog v-if="dialog.save" ref="saveDialog" @success="refresh" :assignmentId="assignmentId"
        @closed="dialog.save = false"></save-dialog>
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
    props: {
        assignmentId: Number
    },
    data () {
        return {
            dialog: {
                save: false,
                permission: false
            },
            loading: false,
            data: [],
            search: {
                keyword: null
            }
        }
    },
    mounted () {
        this.getInputList();
    },
    methods: {
        getInputList () {
            this.loading = true
            this.$API.app.plantingAssignment.input.list.get(this.assignmentId, this.search)
                .then(res => {
                    this.loading = false
                    console.log(res);
                    this.data = res.data
                })
                .catch(() => {
                    this.loading = false
                })
        },

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
                this.$refs.saveDialog.open('edit').setData(row);
            })
        },

        //删除
        del (row) {
            row.$loading = true;
            this.$API.app.plantingAssignment.input.destroy.delete(this.assignmentId, row.id)
                .then(res => {
                    row.$loading = false
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
            this.refresh()
        },

        //本地更新数据
        refresh () {
            this.getInputList()
        }
    }
}
</script>

<style></style>
