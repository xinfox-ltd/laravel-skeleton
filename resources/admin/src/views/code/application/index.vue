<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <!-- <el-button type="primary" icon="el-icon-plus" @click="add"></el-button> -->
            </div>
            <div class="right-panel">
                <!-- <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="角色名称" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div> -->
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="申请编号" prop="id" width="100"></el-table-column>
                <el-table-column label="企业名称" prop="enterprise.name" width="250"></el-table-column>
                <el-table-column label="申请数量" prop="quantity" width="100"></el-table-column>
                <el-table-column label="状态" prop="status" width="80">
                    <template #default="scope">
                        <el-tag>{{ scope.row.status_label }}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column label="申请时间" prop="created_at" width="180"></el-table-column>
                <el-table-column label="审核时间" prop="updated_at" width="180"></el-table-column>
                <el-table-column label="备注" prop="remark" min-width="150"></el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="170">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small" :loading="scope.row.$loading"
                                @click="review(scope.row)">审核</el-button>
                        </el-button-group>
                    </template>
                </el-table-column>

            </scTable>
        </el-main>
    </el-container>

    <review-dialog v-if="dialog.review" ref="reviewDialog" @success="handleSuccess"
        @closed="dialog.save = false"></review-dialog>

    <!-- <permission-dialog v-if="dialog.permission" ref="permissionDialog" @closed="dialog.permission=false"></permission-dialog> -->
</template>

<script>
import reviewDialog from './review'
// import permissionDialog from './permission'

export default {
    name: 'role',
    components: {
        reviewDialog
    },
    data () {
        return {
            dialog: {
                review: false
            },
            list: {
                apiObj: this.$API.app.traceability.list,
            },
            search: {
                keyword: null
            }
        }
    },
    methods: {
        //添加
        review (row) {
            row.$loading = true
            this.$API.app.traceabilityCode.applyfor.info.get(row.id)
                .then(res => {
                    row.$loading = false
                    this.dialog.review = true
                    this.$nextTick(() => {
                        this.$refs.reviewDialog.open(res.data)
                    })
                })

        },

        //搜索
        upsearch () {

        },

        handleSuccess () {
            this.refresh()
        },

        //本地更新数据
        refresh () {
            this.$refs.table.refresh()
        }
    }
}
</script>

<style></style>
