<template>
  <div class="avatar-wrapper has-text-centered">
    <div class="avatar-upload" v-show="!editing">

      <template v-if="isUsersPage">
        <div class="avatar-image-wrapper"> 
          <b-tooltip type="is-dark" position="is-bottom" label="Upload a new avatar">
            <label for="avatar">
              <img :src="avatar.length ? avatar[0].url : (user ? user.avatar_url : user.photo_url)" class="is-rounded member-avatar-img has-hover" />
            </label>
          </b-tooltip>
        </div>
        <file-upload
          extensions="gif,jpg,jpeg,png,webp"
          accept="image/png,image/gif,image/jpeg,image/webp"
          name="avatar"
          class="btn btn-primary"
          post-action="/api/upload/avatar"
          :drop="!editing"
          v-model="avatar"
          @input-filter="inputFilter"
          @input-file="inputFile"
          ref="avatarUpload"
          @input="inputUpdate">
        </file-upload>
      </template>

      <template v-else>
        <img :src="avatar.length ? avatar[0].url : (user ? user.avatar_url : user.photo_url)" class="is-rounded member-avatar-img no-edit" />
      </template>
    </div>

    <!-- Avatar Cropper -->
     <div class="avatar-edit" v-show="avatar.length && editing">
        <div class="avatar-edit-image avatar-crop-image" v-if="avatar.length">
          <img ref="avatarUploadEdit" class="avatar-crop-image" :src="avatar[0].url" />
        </div>
        <div class="text-center avatar-upload-buttons p-4">
          <button type="button" class="button is-secondary" @click.prevent="$refs.avatarUpload.clear">Cancel</button>
          <button type="submit" class="button is-primary" @click.prevent="save">Save</button>
        </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
import { mapState, mapGetters } from 'vuex'
import fileUpload from 'vue-upload-component'
import Cropper from 'cropperjs'

export default {
  name: 'BakdAvatarUpload',

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
      avatar: [],
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
          if (!this.$refs.avatarUploadEdit) {
            return
          }
          let cropper = new Cropper(this.$refs.avatarUploadEdit, {
            aspectRatio: 1 / 1,
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
      let oldFile = this.avatar[0]
      let binStr = atob(this.cropper.getCroppedCanvas().toDataURL(oldFile.type).split(',')[1])
      let arr = new Uint8Array(binStr.length)
      for (let i = 0; i < binStr.length; i++) {
        arr[i] = binStr.charCodeAt(i)
      }
      let file = new File([arr], oldFile.name, { type: oldFile.type })
      this.$refs.avatarUpload.update(oldFile.id, {
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
          this.$store.dispatch('auth/updateUserAvatar', { avatar: uploader[0]['response'] })
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
.member-avatar .avatar-edit-image {
  max-width: 100%
}
.avatar-edit {
  margin: 0 auto 40px; 
  display: block; 
  height: 200px; 
  width: 200px;
}
.member-avatar .drop-active {
  top: 0;
  bottom: 0;
  right: 0;
  left: 0;
  position: fixed;
  z-index: 9999;
  opacity: .6;
  text-align: center;
  background: #000;
}
.member-avatar-img {
  border-radius: 500px;
  background: #fff;
  border: 2px solid #dadada; 
  margin: 0 auto; 
  height: 200px; 
  width: 200px;
  max-width: 100%;
  transition: all .2s ease;
  
  &.has-hover {
    cursor: pointer !important;
    &:hover {
      transition: all .2s ease;
      opacity: 0.9;
    }
  }
}
.avatar-image-wrapper {
  border-radius: 500px; 
  text-align: center; 
  margin: 0 auto; 
  width: 200px; 
  height: 200px; 
  background: #fff; 
  position: relative; 
  z-index: 99;
}
.avatar-crop-image {
  display: block; 
  height: 200px; 
  width: 200px;
}
.avatar-image-wrapper {
  &:hover {
    &:after {
      background: #000;
      cursor: pointer;
      opacity: 0.8;
      transition: all .2s ease;
    }
  }
}
</style>