<template>
  <div> <!-- TODO: Change to transition -->

    <!-- Editable Cover -->
    <template v-if="isUsersPage">
      <file-upload
        extensions="gif,jpg,jpeg,png,webp"
        accept="image/png,image/gif,image/jpeg,image/webp"
        name="cover"
        class="cover-input"
        post-action="/api/upload/cover"
        :drop="!editing"
        v-model="cover"
        @input-filter="inputFilter"
        @input-file="inputFile"
        @input="inputUpdate"
        ref="coverUpload">
        <div class="cover-wrapper" style="background: white;">
          <img :src="cover.length ? cover[0].url : (user.cover_url ? user.cover_url : '')" class="cover-photo" />
          <div class="cover-edit" v-show="cover.length && editing">
            <div class="cover-edit-image" v-if="cover.length">
              <img ref="coverUploadEdit" :src="cover[0].url" />
            </div>
          </div>
        </div>
      </file-upload>
      <div class="text-center cover-photo-buttons p-4" style="display: absolute;" v-show="cover.length && editing">
        <button type="button" class="button is-secondary" @click.prevent="$refs.coverUpload.clear"><i class="la la-times"></i></button>
        <button type="submit" class="button is-primary" @click.prevent="save"><i class="la la-check"></i></button>
      </div>
    </template>
  
    <!-- Read Only Cover -->
    <template v-else>
      <img :src="user ? user.cover_url : ''" class="cover-photo" />
    </template>

  </div>
</template>

<script>
import axios from 'axios'
import { mapState, mapGetters } from 'vuex'
import fileUpload from 'vue-upload-component'
import Cropper from 'cropperjs'

export default {
  name: 'BakdCoverUpload',

  props: {
    user: {
      type: Object,
      required: true
    }
  },

  components: {
    fileUpload
  },

  data () {
    return {
      cover: [],
      editing: false,
      cropper: false,
    }
  },

  computed: {

    ...mapGetters({
      authdUser: 'auth/user',
    }),

    isUsersPage: function () {
      if (this.authdUser.id === this.$props.user.id) {
        return true
      }
      return false
    },
  },

  watch: {
    editing(value) {
      if (value) {
        this.$nextTick(function () {
          if (!this.$refs.coverUploadEdit) {
            return
          }
          let cropper = new Cropper(this.$refs.coverUploadEdit, {
            aspectRatio: 'free',
            dragMode: 'move',
            viewMode: 3,
            autoCropArea: 1
          })
          this.cropper = cropper
        })
      } else {
        if (this.cropper) {
          this.cropper.destroy()
          this.cropper = false
        }
      }
    },
  },

  methods: {
    save() {
      this.editing = false
      let oldFile = this.cover[0]
      let binStr = atob(this.cropper.getCroppedCanvas().toDataURL(oldFile.type).split(',')[1])
      let arr = new Uint8Array(binStr.length)
      for (let i = 0; i < binStr.length; i++) {
        arr[i] = binStr.charCodeAt(i)
      }
      let file = new File([arr], oldFile.name, { type: oldFile.type })
      this.$refs.coverUpload.update(oldFile.id, {
        file,
        type: file.type,
        size: file.size,
        active: true,
      })
    },

    inputUpdate (uploader) {
      if (typeof uploader[0] !== 'undefined') {
        var responseType = typeof uploader[0]['response'];
        if (responseType !== 'undefined' && responseType === 'string') {
          this.$store.dispatch('auth/updateUserCover', { cover: uploader[0]['response'] })
        }
      }
    },
    
    inputFile(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        this.$nextTick(function () {
          this.editing = true
        })
      }
      if (!newFile && oldFile) {
        this.editing = false
      }
    },

    inputFilter(newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        if (!/\.(gif|jpg|jpeg|png|webp)$/i.test(newFile.name)) {
          this.alert('Your choice is not a picture')
          return prevent()
        }
      }
      if (newFile && (!oldFile || newFile.file !== oldFile.file)) {
        newFile.url = ''
        let URL = window.URL || window.webkitURL
        if (URL && URL.createObjectURL) {
          newFile.url = URL.createObjectURL(newFile.file)
        }
      }
    },

  }
}
</script>

<style lang="scss" scoped>
.cover-wrapper {
  z-index: 15; 
  overflow: hidden; 
  height: 300px; 
  top: 0px; 
  left: 0px; 
  right: 0px; 
  margin: 0; 
  padding: 0; 
  width: 100vw; 
  border-bottom: 2px solid #dadada;
}
.cover-input {
  height: 300px; 
  width: 100%; 
  display: block; 
  z-index: 12; 
  position: relative;
}
.cover-photo {
  overflow: hidden; 
  z-index: 15; 
  height: 300px; 
  top: 0px; 
  left: 0px; 
  right: 0px; 
  margin: 0; 
  padding: 0; 
  width: 100vw;
  max-width: 100%;
}
.cover-input label {
  cursor: pointer !important;
  &:hover {
    cursor: pointer !important;
    opacity: 0.8;
    transition: all .2s ease;
  }
}
.cover-photo-buttons {
  position: absolute;
  transition: all .2s ease;
}
.cover-edit {
  position: absolute; 
  top: 0; 
  left: 0; 
  right: 0; 
  height: 300px; 
  display: block; 
  width: 100vw; 
  z-index: 15; 
  display: block;
}
.cover-edit-image {
  height: 300px;
}
</style>