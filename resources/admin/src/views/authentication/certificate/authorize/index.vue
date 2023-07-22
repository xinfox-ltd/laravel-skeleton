<template>
    <el-header>
        <div class="left-panel">
            <el-button type="primary" icon="el-icon-plus" @click="add">新增授权</el-button>
        </div>
        <div class="right-panel">

        </div>
    </el-header>
    <el-main style="padding:0 20px;">
        <scTable ref="table" :apiObj="list.apiObj" :params="list.params" row-key="id" stripe>
            <el-table-column label="#" type="index" width="50"></el-table-column>
            <el-table-column label="证书类型" prop="type_label" width="150"></el-table-column>
            <el-table-column label="证书名称" prop="name" width="200"></el-table-column>
            <el-table-column label="证书编号" prop="certificate_no" width="150"></el-table-column>
            <el-table-column label="颁发机构" prop="authority" width="200"></el-table-column>
            <el-table-column label="证书图片" prop="images" width="300">
                <template #default="scope">
                    <el-space wrap>
                        <el-image style="width: 50px; height: 50px" :src="item" :zoom-rate="1.2"
                            :preview-src-list="scope.row.scan_file" :initial-index="4"
                            v-for="(item, index) in scope.row.scan_file" :key="index" fit="cover"
                            :preview-teleported="true" />
                    </el-space>
                </template>
            </el-table-column>
            <el-table-column label="添加时间" prop="created_at" width="150"></el-table-column>
            <el-table-column label="操作" fixed="right" align="right" width="170">
                <template #default="scope">
                    <el-button-group>
                        <el-button text type="primary" size="small" @click="edit(scope.row)">编辑</el-button>
                        <el-button text type="primary" size="small" @click="authorize(scope.row)">授权</el-button>
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
    props: ["certificateId"],
    components: {
        authorizeDialog
    },
    data () {
        return {
            dialog: {
                authorize: false
            },
            list: {
                apiObj: this.$API.app.certificate.list,
                params: {
                    certificate_id: this.certificateId
                }
            },
        }
    },
    methods: {
        add () {
            this.dialog.authorize = true
            this.$nextTick(() => {
                this.$refs.authorizeDialog.open()
            })
        }
    },
}
</script>