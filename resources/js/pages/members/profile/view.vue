<template>
	<section>

		<file-upload
		  extensions="gif,jpg,jpeg,png,webp"
		  accept="image/png,image/gif,image/jpeg,image/webp"
		  name="cover"
		  class="cover-input"
		  post-action="/api/upload/cover"
		  :drop="!editCover"
		  v-model="cover"
		  @input-filter="inputFilter"
		  @input-file="inputCoverFile"
		  ref="coverUpload">
			<div class="cover-wrapper" style="background: white;">
				<img :src="cover.length ? cover[0].url : (member.cover_url ? member.cover_url : '')" class="cover-photo" />
				<div class="cover-edit" v-show="cover.length && editCover">
					<div class="cover-edit-image" v-if="cover.length">
						<img ref="editCoverImage" :src="cover[0].url" />
					</div>
				</div>
			</div>
		</file-upload>
		<div class="text-center cover-photo-buttons p-4" v-show="cover.length && editCover">
			<button type="button" class="button is-secondary" @click.prevent="$refs.coverUpload.clear"><i class="la la-times"></i></button>
			<button type="submit" class="button is-primary" @click.prevent="editCoverSave"><i class="la la-check"></i></button>
		</div>

		<div class="container profile-container">

			<div class="columns member-avatar">
				
				<div class="column is-9">

					<br />

					<b-tabs v-model="activeTab">
					
			            <b-tab-item label="Realtime" icon="comment">
							
							<template v-for="post in posts">
								<bakd-posted-message :user="member" :post="post" :key="post.id" />
							</template>

			            </b-tab-item>

			            <b-tab-item label="Followers" icon="account">
			                You have no followers
			            </b-tab-item>

			            <b-tab-item label="Following" icon="account-plus">
			                You aren't following anyone yet
			            </b-tab-item>

			            <b-tab-item label="Campaigns" icon="chart-bar">
			                You have no campaigns
			            </b-tab-item>

		        	</b-tabs>

				</div> <!-- .is-9 -->

				<div class="column is-3">
					
					<div class="box" style="margin-top: 0px;">

						<!-- Member Avatar Upload -->
						<div class="avatar-wrapper has-text-centered" style="margin-top: -120px;">
						    <div class="avatar-upload"  v-show="!editAvatar">

								<div class="avatar-image-wrapper">
									<b-tooltip type="is-dark" position="is-bottom" label="Upload a new avatar">
										<label for="avatar">
											<img :src="avatar.length ? avatar[0].url : (member.avatar_url ? member.avatar_url : member.photo_url)" class="is-rounded member-avatar-img" />
										</label>
									</b-tooltip>
								</div>

								 <file-upload
								  extensions="gif,jpg,jpeg,png,webp"
								  accept="image/png,image/gif,image/jpeg,image/webp"
								  name="avatar"
								  class="btn btn-primary"
								  post-action="/api/upload/avatar"
								  :drop="!editAvatar"
								  v-model="avatar"
								  @input-filter="inputFilter"
								  @input-file="inputAvatarFile"
								  ref="avatarUpload">
								</file-upload>
							</div>

							<!-- Avatar Cropper -->
							 <div class="avatar-edit" v-show="avatar.length && editAvatar">
						      <div class="avatar-edit-image avatar-crop-image" v-if="avatar.length">
						        <img ref="editAvatarImage" class="avatar-crop-image" :src="avatar[0].url" />
						      </div>
						      <div class="text-center p-4">
						        <button type="button" class="button is-secondary" @click.prevent="$refs.avatarUpload.clear">Cancel</button>
						        <button type="submit" class="button is-primary" @click.prevent="editAvatarSave">Save</button>
						      </div>
						    </div>

							<p>
								<h2 v-text="member.name" class="is-size-3 is-dark" />
								<span class="tag is-danger">UNVERIFIED</span>
							</p>

							<div class="columns" style="padding: 30px 10px 10px;">
								<div class="column is-6 has-text-centered">
									<p class="title is-size-3">
										{{ member.follower_count }}
									</p>
									<p class="subtitle is-size-6 has-text-grey-light">
										Followers
									</p>
								</div>
								<div class="column is-6 has-text-centered">
									<p class="title is-size-3">
										{{ member.following_count }}
									</p>
									<p class="subtitle is-size-6 has-text-grey-light">
										Following
									</p>
								</div>
							</div>

							<p class="has-text-left">
								<h3 v-text="member.title || 'Add a title'" class="is-size-5 is-title is-dark" />
								<h4 v-text="member.bio || 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio saepe iure quaerat veniam accusantium ipsum blanditiis odit et, laborum, neque quas, veritatis recusandae quibusdam quia? Cupiditate nemo voluptates in quaerat!'" class="is-size-6 is-subtitle is-dark" />
							</p>

							<br />

							<button class="is-fluid button is-rounded is-medium is-wide is-primary is-margin-centered" style="margin-bottom: 8px;">
								<span class="is-size-6"><i class="la la-plus-circle"></i>&nbsp;Follow</span>
							</button>
							<button class="button is-fluid is-rounded is-medium is-wide is-secondary is-margin-centered">
								<span class="is-size-6"><i class="la la-envelope"></i>&nbsp;Message</span>
							</button>

						</div>
						
					</div>




					<!-- Start Social Box -->
					<p class="has-text-left title is-size-5">
						Organizations
					</p>
					<div class="box">
						<ul class="organization-list has-text-centered">
							
							<br /><br />
							<i class="la la-exclamation-triangle has-text-danger is-size-2"></i>
							<p class="is-size-5 title">Coming Soon</p>
							<br /><br />
							
						</ul>
					</div>
					<!-- End Social Box -->




					<!-- Start Social Box -->
					<p class="has-text-left title is-size-5">
						Social Media
					</p>
					<div class="box">
						<ul class="social-list" v-if="member.social">
							
							<template v-for="(network, index) in member.social">
								<li class="level is-marginless" v-if="network && !['id', 'owner_id', 'owner_type', 'created_at', 'updated_at'].includes(index)" :key="index">
									<a class="level-left" :href="network || ''">
										<div class="icon">
											<b-icon :icon="index" pack="fab" :class="getIconClass(index)" />
										</div>
										<span class="is-v-centered" style="padding-left: 5px;">
											{{ network || '' }}
										</span>
									</a>
								</li>
							</template>
							
						</ul>
					</div>
					<!-- End Social Box -->

				</div>

			</div>


		</div>
	</section>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'
import fileUpload from 'vue-upload-component'
import Cropper from 'cropperjs'

// Layout
import BakdPageHeader from '~/components/layout/BakdPageHeader'
import BakdPostedMessage from '~/components/common/BakdPostedMessage'

export default {
	layout: 'default',

	components: {
		fileUpload,
		BakdPageHeader,
		BakdPostedMessage
	},

	data: () => ({
		cover: [],
		avatar: [],
		editCover: false,
		editAvatar: false,
		cropper: false,
		member: {},
		posts: [],
		activeTab: ''
	}),

	computed: {

		...mapGetters({
			user: 'auth/user',
			authenticated: 'auth/check'
		}),

	},

	watch: {
	    editAvatar(value) {
	      if (value) {
	        this.$nextTick(function () {
	          if (!this.$refs.editAvatarImage) {
	            return
	          }
	          let cropper = new Cropper(this.$refs.editAvatarImage, {
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
	    editCover(value) {
	      if (value) {
	        this.$nextTick(function () {
	          if (!this.$refs.editCoverImage) {
	            return
	          }
	          let cropper = new Cropper(this.$refs.editCoverImage, {
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
	    }
	  },

	methods: {
		fetchUserData: async function () {
			var { data } = await axios.get(`/api/u/${this.$route.params.id}`)
			this.member = data.data.member;
			console.log(data.data.member);
		},
		fetchUserPosts: async function () {
			try {
				var { data } = await axios.get(`/api/u/${this.$route.params.id}/posts`)
				this.posts = data.data
				console.log(data.data)
			} catch (err) {
				alert(err)
			}
		},
	    editCoverSave() {
	      this.editCover = false
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
	    editAvatarSave() {
	      this.editAvatar = false
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
	    alert(message) {
	      alert(message)
	    },
	    inputAvatarFile(newFile, oldFile, prevent) {
	      if (newFile && !oldFile) {
	        this.$nextTick(function () {
	          this.editAvatar = true
	        })
	      }
	      if (!newFile && oldFile) {
	        this.editAvatar = false
	      }
	    },
	    inputCoverFile(newFile, oldFile, prevent) {
	      if (newFile && !oldFile) {
	        this.$nextTick(function () {
	          this.editCover = true
	        })
	      }
	      if (!newFile && oldFile) {
	        this.editCover = false
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
	    getIconClass(network) {
	    	var className = 'is-' + network
	    	if (network === 'medium') {
	    		className = 'is-medium-blog'
	    	}
	    	return className;
	    }
	},

	metaInfo () {
		return { title: this.$t('View Profile') }
	},

	mounted () {
		this.fetchUserData()
		this.fetchUserPosts()
	}
}
</script>


<style lang="scss" scoped>
.social-list {
	li:first-child {
		padding: 15px 5px;
	}
	li:not(:first-child) {
		padding: 15px 5px;
		border-top: 1px solid #ededed;
	}
}
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
.profile-container {
	z-index: 99;
}
.member-avatar-img {
	border-radius: 500px; 
	margin: 0 auto; 
	height: 200px; 
	width: 200px;
	max-width: 100%;
	cursor: pointer !important;
	transition: all .2s ease;
	&:hover {
		transition: all .2s ease;
		opacity: 0.9;
	}
}
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
.avatar-image-wrapper {
	border-radius: 500px; 
	text-align: center; 
	margin: 0 auto; 
	width: 200px; 
	height: 200px; 
	border: 2px solid #dadada; 
	// border: 2px solid #f5f5f5; 
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