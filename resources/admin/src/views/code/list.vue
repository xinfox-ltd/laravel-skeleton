<template>
    <el-container>
        <el-header>
            <div class="left-panel">
                <div class="right-panel-search">
                    <el-input v-model="search.keyword" placeholder="序号" clearable></el-input>
                    <el-button type="primary" icon="el-icon-search" @click="upsearch"></el-button>
                </div>
            </div>
        </el-header>
        <el-main class="nopadding">
            <scTable ref="table" :apiObj="list.apiObj" row-key="id" stripe>
                <el-table-column label="#" type="index" width="50"></el-table-column>
                <el-table-column label="序号" prop="serial_number" width="150"></el-table-column>
                <el-table-column label="验证码" prop="code" width="200"></el-table-column>
                <el-table-column label="溯源码有效期（天）" prop="effective_day" width="150"></el-table-column>
                <el-table-column label="启用日期" prop="enable_date" width="100"></el-table-column>
                <el-table-column label="失效日期" prop="expire_date" width="100"></el-table-column>
                <el-table-column label="企业名称" prop="enterprise.name" width="280"></el-table-column>
                <el-table-column label="状态" prop="status" width="80">
                    <template #default="scope">
                        <el-tag type="success" v-if="scope.row.status == 10">{{ scope.row.status_label }}</el-tag>
                        <el-tag type="danger" v-else-if="scope.row.status == 2">{{ scope.row.status_label }}</el-tag>
                        <el-tag v-else>{{ scope.row.status_label }}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column label="操作" fixed="right" align="right" width="130">
                    <template #default="scope">
                        <el-button-group>
                            <el-button text type="primary" size="small"
                                @click="qrcode(scope.row, scope.$index)">查看</el-button>
                            <el-popconfirm title="确定作废吗？" @confirm="cancel(scope.row, scope.$index)">
                                <template #reference>
                                    <el-button text type="primary" size="small">作废</el-button>
                                </template>
                            </el-popconfirm>
                        </el-button-group>
                    </template>
                </el-table-column>

            </scTable>
        </el-main>
    </el-container>

    <qrcode-dialog v-if="dialog.qrcode" ref="qrcodeDialog" @closed="dialog.qrcode = false"></qrcode-dialog>

    <!-- <permission-dialog v-if="dialog.permission" ref="permissionDialog" @closed="dialog.permission=false"></permission-dialog> -->
</template>

<script>
import qrcodeDialog from './qrcode'
// import permissionDialog from './permission'

export default {
    name: 'role',
    components: {
        qrcodeDialog,
        // permissionDialog
    },
    data () {
        return {
            dialog: {
                save: false,
                permission: false
            },
            list: {
                apiObj: this.$API.app.traceabilityCode.list,
            },
            search: {
                keyword: null
            }
        }
    },
    methods: {
        qrcode (row) {
            this.dialog.qrcode = true
            this.$nextTick(() => {
                this.$refs.qrcodeDialog.open().setData(row)
            })
        },

        //废弃
        async cancel (row) {
            this.$API.app.traceabilityCode.operate.post(row.id, { action: 'disable' })
                .then(() => {
                    this.$refs.table.refresh()
                    this.$message.success("操作成功")
                })
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
