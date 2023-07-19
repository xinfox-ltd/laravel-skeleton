<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <el-button type="primary" icon="el-icon-plus" @click="add"></el-button>
            </div>
            <div class="right-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="企业名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="企业名称" prop="name" width="150"></el-table-column>
                <el-table-column label="企业类型" prop="type_label" width="150"></el-table-column>
                <el-table-column label="联系电话" prop="phone" width="120"></el-table-column>
                <el-table-column label="企业法人" prop="legal_person" width="80"></el-table-column>
                <el-table-column label="企业地址" prop="address" width="200"></el-table-column>
                <el-table-column label="产品" prop="products" width="150"></el-table-column>
                <el-table-column label="状态" prop="status" width="80">

                </el-table-column>
                <el-table-column label="申请时间" prop="created_at" width="180"></el-table-column>
                <el-table-column label="审核时间" prop="audited_at" width="180"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="170">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small"
                                @click="edit(scope.row, scope.$index)">编辑</el-button>
                            <el-popconfirm title="确定删除吗？" @confirm="del(scope.row, scope.$index)">
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
                apiObj: this.$API.app.enterprise.list,
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
