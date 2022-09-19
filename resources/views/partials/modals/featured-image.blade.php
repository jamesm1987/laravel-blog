<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="featured-image-modal" tabindex="-1" aria-labelledby="featured-image" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg relative w-auto pointer-events-none">
    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
      <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
        <h5 class="text-xl font-medium leading-normal text-gray-800" id="featured-image">
          Featured Image
        </h5>
        <button type="button"
          class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
          data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body relative p-4">
        Upload Image or <a class="link text-blue-500" href="#">Select from Media Library</a>
        <form action="{{ route('admin.post-featured-image', ['post' => $id]) }}" class="my-4" method="POST">
          @csrf
          <input class="block mb-5 w-full text-xs text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" name="featured-image" id="featured-image-upload" type="file">
          <button class="px-2 py-1 bg-blue-800 text-white" type="submit">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>