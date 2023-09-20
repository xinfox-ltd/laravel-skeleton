<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" v-loading="loading" :data="data" row-key="id" hidePagination hideDo stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="名称" prop="name" width="200"></el-table-column>
                <el-table-column label="面积" prop="area" width="120">
                    <template #default="scope">{{ scope.row.area }}</template>
                </el-table-column>
                <el-table-column label="负责人" prop="manager.name" width="150"></el-table-column>
                <el-table-column label="描述" prop="remark" width="150"></el-table-column>
                <el-table-column label="添加时间" prop="created_at" width="150"></el-table-column>
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

    <save-dialog v-if="dialog.save" ref="saveDialog" @success="refresh" @closed="dialog.save = false"></save-dialog>
</template>

<script>
import saveDialog from './save'

export default {
    name: 'pieceList',
    components: {
        saveDialog,
    },
    props: {
        base: Object
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
        this.getProductionBasePieceList();
    },
    methods: {
        getProductionBasePieceList () {
            this.loading = true
            this.search.base_id = this.base.id;
            this.$API.app.productionBase.piece.list.get(this.search)
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
                this.$refs.saveDialog.open().setBaseId(this.base.id)
            })
        },
        //编辑
        edit (row) {
            this.dialog.save = true
            this.$nextTick(() => {
                this.$refs.saveDialog.open('edit').setBaseId(this.base.id).setData(row);
            })
        },

        //删除
        del (row) {
            row.$loading = true;
            this.$API.app.productionBase.piece.clear.delete(this.base.id, row.id)
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
            this.getProductionBasePieceList()
        }
    }
}
</script>

<style></style>
